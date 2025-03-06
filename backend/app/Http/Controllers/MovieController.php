<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Movie;

class MovieController extends Controller
{
    // Listar todas las películas
    public function index()
    {
        $movies = Movie::all();
        return response()->json($movies);
    }

    // Guardar una nueva película
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string',
            'description' => 'required|string',
            'poster_url'  => 'required|url',
            'duration'    => 'required|integer',
        ]);

        $movie = Movie::create($data);
        return response()->json($movie, 201);
    }

    // Mostrar una película en específico
    public function show(Movie $movie)
    {
        return response()->json($movie);
    }

    // Actualizar una película
    public function update(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'title'       => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'poster_url'  => 'sometimes|required|url',
            'duration'    => 'sometimes|required|integer',
        ]);

        $movie->update($data);
        return response()->json($movie);
    }

    // Eliminar una película
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(null, 204);
    }
}