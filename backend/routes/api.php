<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SessionMovieController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;



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

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::apiResource('/admin/movie-sessions', MovieSessionController::class);
});

// Rutas para las sesiones
Route::get('/sessions', [SessionMovieController::class, 'index']); // Listar todas las sesiones
Route::get('/sessions/{id}', [SessionMovieController::class, 'show']); // Mostrar una sesión específica
Route::post('/sessions', [SessionMovieController::class, 'store']); // Crear una nueva sesión
Route::put('/sessions/{id}', [SessionMovieController::class, 'update']); // Actualizar una sesión
Route::delete('/sessions/{id}', [SessionMovieController::class, 'destroy']); // Eliminar una sesión

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
