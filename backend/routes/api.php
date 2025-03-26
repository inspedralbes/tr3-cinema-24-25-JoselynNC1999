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
use App\Http\Controllers\MovieSessionController; // Asegurar que se importe

// 🟢 Rutas de Autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con autenticación
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
            'is_admin' => $request->user()->is_admin,
        ]);
    });
});

// 🟢 Rutas Públicas (Accesibles sin autenticación)
Route::apiResource('movies', MovieController::class);
Route::get('/movies/{movie_id}/sessions', [SessionMovieController::class, 'getSessionsByMovie']);
Route::get('/seats', [SeatController::class, 'index']);

// 🟢 Rutas para las sesiones de películas
Route::apiResource('sessions', SessionMovieController::class);
Route::get('/sessions/{sessionId}/seats', [SeatController::class, 'getSeatsBySession']);
Route::get('/sessions/{sessionId}/occupied-seats', [SeatController::class, 'getOccupiedSeats']);

// 🟢 Rutas para reservaciones y boletos
Route::post('/reservations', [ReservationController::class, 'storeReservation']);
Route::get('/reservations', [ReservationController::class, 'index']);
Route::get('/reservations/{id}', [ReservationController::class, 'show']);
Route::post('/reserve-seats', [SeatController::class, 'reserveSeats']);
Route::post('/send-ticket-email', [EmailController::class, 'sendTicketEmail']);

// 🛑 Rutas de Administrador (Protegidas con Middleware)
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::apiResource('/admin/movie-sessions', MovieSessionController::class);
});

Route::get('/dates', [SessionMovieController::class, 'getDates']);

