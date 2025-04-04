<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Seat;
use App\Models\SessionMovie;
use Illuminate\Support\Facades\DB;


class ReservationController extends Controller
{

    public function index()
{
    return response()->json(Reservation::all());
}


public function show($id)
{
    $reservation = Reservation::find($id);

    if (!$reservation) {
        return response()->json(['message' => 'Reserva no encontrada'], 404);
    }

    // Obtener los asientos de la reserva
    $seats = DB::table('reservation_seat')
        ->where('reservation_id', $id)
        ->join('seats', 'reservation_seat.seat_id', '=', 'seats.id')
        ->select('seats.*')
        ->get();

    return response()->json([
        'reservation' => $reservation,
        'seats' => $seats
    ]);
}


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
