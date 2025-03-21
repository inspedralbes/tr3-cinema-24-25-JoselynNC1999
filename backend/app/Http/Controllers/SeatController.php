<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            'status'     => 'sometimes|required|in:available,occupied,selected',
            'type'       => 'sometimes|required|in:normal,VIP',
        ]);

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
            'status'     => 'sometimes|required|in:available,occupied,selected',
            'type'       => 'sometimes|required|in:normal,VIP',
        ]);

        $seat->update($data);
        return response()->json($seat);
    }
    public function getSeatsBySession($sessionId) {
        $seats = Seat::where('session_id', $sessionId)->get();
        return response()->json($seats);
    }
    
    public function reserveSeats(Request $request)
{
    try {
        DB::beginTransaction(); // Inicia la transacción

        // Validar datos de entrada
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'session_id' => 'required|exists:session_movies,id',
            'seat_ids' => 'required|array',
            'seat_ids.*' => 'exists:seats,id'
        ]);

        // Crear reserva
        $reservation = Reservation::create([
            'user_id' => $request->user_id,
            'session_id' => $request->session_id,
            'status' => 'pending'
        ]);

        // Asociar asientos a la reserva
        foreach ($request->seat_ids as $seat_id) {
            DB::table('reservation_seat')->insert([
                'reservation_id' => $reservation->id,
                'seat_id' => $seat_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        DB::commit(); // Confirma la transacción
        return response()->json(['message' => 'Reserva realizada con éxito', 'reservation_id' => $reservation->id], 201);

    } catch (\Exception $e) {
        DB::rollBack(); // Revierte la transacción en caso de error
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
