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
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\EmailController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('movies', MovieController::class);
Route::apiResource('sessions', SessionMovieController::class);
Route::apiResource('tickets', TicketController::class);
Route::apiResource('users', UserController::class);
Route::get('/seats', [SeatController::class, 'index']);


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
Route::post('/reserve-seats', [SeatController::class, 'reserveSeats']);

Route::post('/reservations', [ReservationController::class, 'storeReservation']);

Route::get('/sessions/{sessionId}/seats', [SeatController::class, 'getSeatsBySession']);
Route::get('/seats/all', [SeatController::class, 'getAllSeats']);

Route::get('/sessions/{sessionId}/occupied-seats', [SeatController::class, 'getOccupiedSeats']);

Route::get('/reservations', [ReservationController::class, 'index']);
Route::get('/reservations/{id}', [ReservationController::class, 'show']);
Route::post('/send-ticket-email', [EmailController::class, 'sendTicketEmail']);








