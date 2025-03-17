<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function reserveSeats(Request $request)
{
    $request->validate([
        'session_id' => 'required|exists:session_movies,id',
        'seats' => 'required|array',
        'seats.*' => 'exists:seats,id'
    ]);

    $user = auth()->user();

    // Crear la reserva
    $reservation = Reservation::create([
        'user_id' => $user->id,
        'session_id' => $request->session_id,
        'status' => 'pending'
    ]);

    // Asignar los asientos a la reserva
    $reservation->seats()->attach($request->seats);

    return response()->json(['message' => 'Reserva creada con éxito', 'reservation_id' => $reservation->id]);
}

}
