<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SessionMovieController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
// Ruta para mostrar el formulario de edición
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

Route::resource('movies', MovieController::class)->except(['create', 'edit']);
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

Route::resource('sessions', SessionMovieController::class);

