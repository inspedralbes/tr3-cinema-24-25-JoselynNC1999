<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    // Mostrar todas las películas
    public function index()
    {
        $movies = Movie::all();

        if (request()->expectsJson()) {
            return response()->json($movies);
        }

        return view('movies', compact('movies'));
    }

    // Mostrar una película
    public function show(Movie $movie)
    {
        return response()->json($movie); 
    }

    // Guardar una nueva película
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'poster_url'  => 'required|url',
            'duration'    => 'required|integer|min:1',
        ]);

        $movie = Movie::create($data);

        if ($request->expectsJson()) {
            return response()->json($movie, 201);
        }

        return redirect()->route('movies.index')->with('success', 'Pel·lícula creada correctament.');
    }

    // Actualizar una película
    public function update(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'poster_url'  => 'sometimes|required|url',
            'duration'    => 'sometimes|required|integer|min:1',
        ]);

        $movie->update($data);

        if ($request->expectsJson()) {
            return response()->json($movie);
        }

        return redirect()->route('movies.index')->with('success', 'Pel·lícula actualitzada correctament.');
    }

    // Eliminar una película
    public function destroy(Movie $movie)
    {
        $movie->delete();

        if (request()->expectsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('movies.index')->with('success', 'Pel·lícula eliminada correctament.');
    }
}
