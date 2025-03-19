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
            $table->foreignId('movie_id')->constrained()->onDelete('cascade'); // Película reservada
            $table->foreignId('session_id')->constrained('session_movies')->onDelete('cascade'); // Función de cine
            $table->integer('seats')->default(1); // Número de asientos reservados
            $table->decimal('total_price', 8, 2)->default(0.00); // Precio total de la reserva
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending'); // Estado de la reserva
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
