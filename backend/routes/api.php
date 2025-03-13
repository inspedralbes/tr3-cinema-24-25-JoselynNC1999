<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SessionMovieController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('movies', MovieController::class);
Route::apiResource('sessions', SessionMovieController::class);
Route::apiResource('seats', SeatController::class);
Route::apiResource('tickets', TicketController::class);
Route::apiResource('users', UserController::class);

// Ruta para obtener las sesiones de una película específica
Route::get('/movies/{movie_id}/sessions', [SessionMovieController::class, 'getSessionsByMovie']);



