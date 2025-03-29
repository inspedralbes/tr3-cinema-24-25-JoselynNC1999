<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovieSession;


class MovieSessionController extends Controller
{
    public function index()
    {
        return MovieSession::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_title' => 'required|string',
            'cinema_room' => 'required|string',
            'showtime' => 'required|date',
        ]);

        return MovieSession::create($request->all());
    }

    public function show(MovieSession $movieSession)
    {
        return $movieSession;
    }

    public function update(Request $request, MovieSession $movieSession)
    {
        $movieSession->update($request->all());
        return $movieSession;
    }

    public function destroy(MovieSession $movieSession)
    {
        $movieSession->delete();
        return response()->json(['message' => 'Sesión eliminada']);
    }
}
