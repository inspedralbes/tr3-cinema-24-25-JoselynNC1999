<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Seat;
use App\Models\SessionMovie;

class ReservationController extends Controller
{

    public function storeReservation(Request $request)
{
    $user = auth()->user(); // Obtén el usuario autenticado
    $session = SessionMovie::findOrFail($request->session_id); // Obtén la sesión de la película
    
    // Crea una nueva reserva
    $reservation = Reservation::create([
        'user_id' => $user->id,
        'session_id' => $session->id,
        'status' => 'pending', // Estado inicial
    ]);

    // Ahora, vincula los asientos seleccionados a la reserva
    foreach ($request->selected_seats as $seatId) {
        // Verifica si el asiento existe
        $seat = Seat::find($seatId);
        if ($seat) {
            // Vincula el asiento con la reserva
            $reservation->seats()->attach($seat);
        }
    }

    return response()->json([
        'message' => 'Reserva creada correctamente.',
        'reservation' => $reservation
    ]);
}
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
