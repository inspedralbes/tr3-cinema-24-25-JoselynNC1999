<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;

class TicketController extends Controller
{
    // Listar todos los tickets con relaciones
    public function index()
    {
        return response()->json(Ticket::with(['user', 'session', 'seat'])->get());
    }

    // Crear un ticket
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'    => 'required|exists:users,id',
            'session_id' => 'required|exists:session_movies,id',
            'seat_id'    => 'required|exists:seats,id',
            'price'      => 'required|numeric|min:0',
        ]);

        $ticket = Ticket::create($data);
        return response()->json($ticket, 201);
    }

    // Mostrar un ticket específico con sus relaciones
    public function show(Ticket $ticket)
    {
        return response()->json($ticket->load(['user', 'session', 'seat']));
    }

    // Eliminar un ticket
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return response()->json(null, 204);
    }
}
