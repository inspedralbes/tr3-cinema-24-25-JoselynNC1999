<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('session_movies', function (Blueprint $table) {
        $table->id();
        $table->foreignId('movie_id')->constrained('movies')->onDelete('cascade'); // Relación con la tabla `movies`
        $table->date('date'); // Fecha de la sesión
        $table->time('time'); // Hora de la sesión
        $table->boolean('is_special')->default(false); // Indica si es una sesión especial (ej. día del espectador)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_movies');
    }
};
