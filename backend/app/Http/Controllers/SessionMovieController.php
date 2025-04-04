<?php

namespace App\Http\Controllers;

use App\Models\SessionMovie;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;


class SessionMovieController extends Controller
{
    // Listar todas las sesiones para la web
   
public function index(Request $request)
{
    $query = SessionMovie::query();

    if ($request->has('movieId')) {
        $query->where('movie_id', $request->movieId);
    }
    $sessions = $query->with('movie')
    ->where('date', '>=', now()->toDateString())
    ->where('date', '<=', now()->addDays(12)->toDateString())
    ->where('time', '16:00') // Filtrar por horario de 16:00
    ->get();
        $movies = Movie::all();

        return response()->json($sessions);
        return view('sessions', compact('sessions', 'movies'));

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

        $times = ['16:00', '18:00', '20:00'];

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

    // Obtener sesiones por película (para API, no modificado)
    public function getSessionsByMovie($movie_id)
    {
            // Verificar si la película existe

        $movie = Movie::find($movie_id);
        if (!$movie) {
            return response()->json(['message' => 'Película no encontrada'], 404);
        }

        $sessions = SessionMovie::where('movie_id', $movie_id)->with('movie')->get();

        return response()->json([
            'movie' => $movie,
            'sessions' => $sessions
        ]);
    }

    public function getDates()
    {
        // Obtener fechas únicas ordenadas desde hoy en adelante
        $dates = SessionMovie::where('date', '>=', Carbon::today())
            ->orderBy('date', 'asc')
            ->pluck('date')
            ->map(function ($date) {
                return Carbon::parse($date)->translatedFormat('D, d M'); // Formato "Lun, 18 Mar"
            });

        return response()->json($dates);
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
