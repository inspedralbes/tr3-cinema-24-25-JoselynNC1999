<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    // Obtener todas las reservas de un usuario
    public function index(Request $request)
    {
        $userId = $request->query('user_id');
        
        if (!$userId) {
            return response()->json(['message' => 'Se requiere un user_id'], 400);
        }

        $reservations = Reservation::where('user_id', $userId)->with(['movie', 'session'])->get();

        return response()->json($reservations, 200);
    }

    // Crear una nueva reserva
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movies,id',
            'session_id' => 'required|exists:session_movies,id',
            'seats' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        $reservation = Reservation::create([
            'user_id' => $request->user_id,
            'movie_id' => $request->movie_id,
            'session_id' => $request->session_id,
            'seats' => $request->seats,
            'total_price' => $request->total_price,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Reserva creada con éxito', 'reservation' => $reservation], 201);
    }

    // Obtener detalles de una reserva
    public function show($id)
    {
        $reservation = Reservation::with(['user', 'movie', 'session'])->find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }

        return response()->json($reservation, 200);
    }

    // Actualizar una reserva (ejemplo: confirmar o cancelar)
    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->status = $request->status;
        $reservation->save();

        return response()->json(['message' => 'Reserva actualizada', 'reservation' => $reservation], 200);
    }

    // Eliminar una reserva
    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }

        $reservation->delete();

        return response()->json(['message' => 'Reserva eliminada'], 200);
    }
}