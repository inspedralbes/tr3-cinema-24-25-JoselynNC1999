<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuario que hizo la reserva
            $table->foreignId('session_id')->constrained('session_movies')->onDelete('cascade'); // Función de cine
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending'); // Estado de la reserva
            $table->timestamps();
        });

        // Tabla pivote entre reservations y seats para guardar los asientos reservados
        Schema::create('reservation_seat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade'); // Relación con reservations
            $table->foreignId('seat_id')->constrained()->onDelete('cascade'); // Relación con seats
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservation_seat');
        Schema::dropIfExists('reservations');
    }
};