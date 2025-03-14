<?php

namespace App\Http\Controllers;

use App\Models\SessionMovie;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SessionMovieController extends Controller
{
    // Listar todas las sesiones (para web y API)
    public function index()
    {
        $sessions = SessionMovie::with('movie')->get();

        if (request()->wantsJson()) {
            return response()->json($sessions);
        }

        return view('sessions', compact('sessions'));
    }

    // Mostrar una sesión específica
    public function show(SessionMovie $sessionMovie)
    {
        if (request()->wantsJson()) {
            return response()->json($sessionMovie);
        }

        return view('sessions.show', compact('sessionMovie'));
    }

    // Guardar una nueva sesión
    public function store(Request $request)
    {
        $request->validate([
            'movie_id'   => 'required|exists:movies,id',
            'date'       => 'required|date',
            'is_special' => 'sometimes|boolean',
        ]);

        // Horarios disponibles
        $times = ['16:00', '18:00', '20:00'];

        // Crear una sesión para cada horario
        foreach ($times as $time) {
            SessionMovie::create([
                'movie_id'   => $request->movie_id,
                'date'       => $request->date,
                'time'       => $time,
                'is_special' => $request->is_special ?? false,
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json(SessionMovie::where('date', $request->date)->get(), 201);
        }

        return redirect()->route('sessions.index')->with('success', 'Sessions creades correctament.');
    }

    // Actualizar una sesión
    public function update(Request $request, SessionMovie $sessionMovie)
    {
        $request->validate([
            'movie_id'   => 'sometimes|required|exists:movies,id',
            'date'       => ['sometimes', 'required', 'date'],
            'time'       => ['sometimes', 'required', 'date_format:H:i'],
            'is_special' => 'sometimes|boolean',
        ]);

        $sessionMovie->update($request->all());

        if ($request->wantsJson()) {
            return response()->json($sessionMovie);
        }

        return redirect()->route('sessions.index')->with('success', 'Sessió actualitzada correctament.');
    }

    // Eliminar una sesión
    public function destroy(SessionMovie $sessionMovie)
    {
        $sessionMovie->delete();

        if (request()->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('sessions.index')->with('success', 'Sessió eliminada correctament.');
    }
}