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

    // Eliminar una butaca
    public function destroy(Seat $seat)
    {
        $seat->delete();
        return response()->json(null, 204);
    }
}
