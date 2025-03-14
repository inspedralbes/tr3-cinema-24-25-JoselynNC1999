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
        $table->date('date'); // Fecha de la sesión (sin unicidad)
        $table->enum('time', ['16:00', '18:00', '20:00']); // Horarios fijos
        $table->boolean('is_special')->default(false); // Indica si es una sesión especial (ej. día del espectador)
        $table->timestamps();
    
        // Asegurar que no haya duplicados de sesión en la misma fecha y hora
        $table->unique(['date', 'time']);
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
