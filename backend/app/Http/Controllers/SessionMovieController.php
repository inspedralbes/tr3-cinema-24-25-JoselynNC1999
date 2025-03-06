<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\SessionMovie;
use Illuminate\Http\Request;

class SessionMovieController extends Controller
{
    // Listar todas las sesiones de película
    public function index()
    {
        return response()->json(SessionMovie::all());
    }

    // Guardar una nueva sesión
    public function store(Request $request)
    {
        $data = $request->validate([
            'movie_id'   => 'required|exists:movies,id',
            'date'       => 'required|date',
            'time'       => 'required|date_format:H:i:s', // Formato de hora correcto
            'is_special' => 'sometimes|boolean',
        ]);

        $session = SessionMovie::create($data);
        return response()->json($session, 201);
    }

    // Mostrar una sesión en específico
    public function show(SessionMovie $sessionMovie)
    {
        return response()->json($sessionMovie);
    }

    // Actualizar una sesión
    public function update(Request $request, SessionMovie $sessionMovie)
    {
        $data = $request->validate([
            'movie_id'   => 'sometimes|required|exists:movies,id',
            'date'       => 'sometimes|required|date',
            'time'       => 'sometimes|required|date_format:H:i:s', // Se asegura de que el formato sea correcto
            'is_special' => 'sometimes|boolean',
        ]);

        $sessionMovie->update($data);
        return response()->json($sessionMovie);
    }

    // Eliminar una sesión
    public function destroy(SessionMovie $sessionMovie)
    {
        $sessionMovie->delete();
        return response()->json(null, 204);
    }
}