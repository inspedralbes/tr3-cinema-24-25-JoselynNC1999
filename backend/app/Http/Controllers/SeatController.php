<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use App\Models\Seat;


class SeatController extends Controller
{
    // Listar todas las butacas
    public function index()
    {
        $seats = Seat::all();
        return response()->json($seats);
    }

    // Guardar una nueva butaca
    public function store(Request $request)
    {
        $data = $request->validate([
            'session_id' => 'required|exists:session_movies,id',
            'row'        => 'required|string',
            'number'     => 'required|integer',
            'status'     => 'sometimes|required|boolean',  // Validar como booleano
            'type'       => 'sometimes|required|in:normal,VIP',
        ]);

        // Si no se pasa el status, se establece como 'false' (disponible) por defecto
        if (!isset($data['status'])) {
            $data['status'] = false;
        }

        $seat = Seat::create($data);
        return response()->json($seat, 201);
    }


    // Mostrar una butaca en específico
    public function show(Seat $seat)
    {
        return response()->json($seat);
    }

    // Actualizar una butaca
    public function update(Request $request, Seat $seat)
    {
        $data = $request->validate([
            'session_id' => 'sometimes|required|exists:session_movies,id',
            'row'        => 'sometimes|required|string',
            'number'     => 'sometimes|required|integer',
            'status'     => 'sometimes|required|boolean', // Validar como booleano
            'type'       => 'sometimes|required|in:normal,VIP',
        ]);

        // Actualizar el asiento
        $seat->update($data);
        return response()->json($seat);
    }
    
    public function getSeatsBySession($sessionId)
{
    // Obtener todos los asientos que pertenecen a la sesión con el id proporcionado
    $seats = Seat::where('session_id', $sessionId)->get();

    // Verificar si hay asientos disponibles
    if ($seats->isEmpty()) {
        return response()->json(['message' => 'No hay asientos disponibles para esta sesión.'], 404);
    }

    // Retornar los asientos encontrados
    return response()->json($seats, 200);
}

    
    
public function getOccupiedSeats($sessionId)
{
    try {
        // Verifica si la sesión existe
        $sessionExists = DB::table('session_movies')->where('id', $sessionId)->exists();
        if (!$sessionExists) {
            return response()->json([
                'message' => 'La sesión especificada no existe'
            ], 404);
        }
        
        // Obtiene los asientos ocupados (status = 1 o true)
        $occupiedSeats = Seat::where('session_id', $sessionId)
                             ->where('status', true)
                             ->get();
        
        // Siempre devuelve una colección (que se serializa como array)
        return response()->json($occupiedSeats, 200);
    } catch (\Exception $e) {
        // Log del error para depuración en el servidor
        \Log::error('Error en getOccupiedSeats: ' . $e->getMessage());
        
        return response()->json([
            'message' => 'Error al obtener asientos ocupados',
            'error' => $e->getMessage()
        ], 500);
    }
}
        

public function getAllSeats()
{
    $seats = Seat::all();  // Obtiene todos los asientos
    return response()->json($seats);
}

public function reserveSeats(Request $request)
{
    try {
        DB::beginTransaction();

        // Validar datos de entrada
        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'session_id' => 'required|exists:session_movies,id',
            'seat_ids'   => 'required|array',
            'seat_ids.*' => 'exists:seats,id'
        ]);

        // Verificar si los asientos ya están ocupados
        $occupiedSeats = Seat::whereIn('id', $request->seat_ids)
                             ->where('status', true)
                             ->count();

        if ($occupiedSeats > 0) {
            return response()->json(['error' => 'Uno o más asientos ya están ocupados'], 400);
        }

        // Crear reserva
        $reservation = Reservation::create([
            'user_id'    => $request->user_id,
            'session_id' => $request->session_id,
            'status'     => 'pending'
        ]);

        // Asociar asientos a la reserva y marcarlos como ocupados
        foreach ($request->seat_ids as $seat_id) {
            DB::table('reservation_seat')->insert([
                'reservation_id' => $reservation->id,
                'seat_id'        => $seat_id,
                'created_at'     => now(),
                'updated_at'     => now()
            ]);

            // Actualizar el estado del asiento a ocupado (true)
            Seat::where('id', $seat_id)->update(['status' => true]);
        }

        DB::commit();
        return response()->json(['message' => 'Reserva realizada con éxito', 'reservation_id' => $reservation->id], 201);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['error' => 'Error al reservar butacas', 'message' => $e->getMessage()], 500);
    }
}

    // Eliminar una butaca
    public function destroy(Seat $seat)
    {
        $seat->delete();
        return response()->json(null, 204);
    }
}
