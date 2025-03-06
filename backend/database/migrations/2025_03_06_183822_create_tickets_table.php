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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con la tabla `users`
            $table->foreignId('session_id')->constrained('sessions_Movie')->onDelete('cascade'); // Relación con la tabla `sessions_Movie`
            $table->foreignId('seat_id')->constrained()->onDelete('cascade'); // Relación con la tabla `seats`
            $table->decimal('price', 8, 2); // Precio de la entrada
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
