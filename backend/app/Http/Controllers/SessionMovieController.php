<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\SessionMovie;
use App\Models\Movie;
use Illuminate\Http\Request;

class SessionMovieController extends Controller
{
    // Listar todas las sesiones de película
    public function index()
    {
        return response()->json(SessionMovie::all());
    }

    public function getSessionsByMovie($movie_id)
    {
        $sessions = SessionMovie::where('movie_id', $movie_id)->with('movie')->get();

        if ($sessions->isEmpty()) {
            return response()->json(['message' => 'No hay sesiones para esta película.'], 404);
        }

        return response()->json($sessions);
    }

    // Guardar una nueva sesión
    public function store(Request $request)
    {
        // Validar que no haya ya una sesión para ese día
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'date' => 'required|date|unique:session_movies,date',
            'time' => 'required|date_format:H:i:s',
            'is_special' => 'sometimes|boolean',
        ]);

        // Crear la nueva sesión
        $session = SessionMovie::create([
            'movie_id' => $request->movie_id,
            'date' => $request->date,
            'time' => $request->time,
            'is_special' => $request->is_special ?? false,
        ]);

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
            'date'       => ['sometimes', 'required', 'date', Rule::unique('sessions', 'date')->ignore($session->id)], // Asegura que no haya más de una sesión por día
            'time'       => ['sometimes', 'required', Rule::in(['16:00', '18:00', '20:00'])], // Solo horarios válidos
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