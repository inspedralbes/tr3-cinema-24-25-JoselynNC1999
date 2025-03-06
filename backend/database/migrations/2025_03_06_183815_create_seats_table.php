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
    Schema::create('seats', function (Blueprint $table) {
        $table->id();
        $table->foreignId('session_id')->constrained()->onDelete('cascade'); // Relación con la tabla `sessions`
        $table->string('row'); // Fila de la butaca (ej. "A", "B", etc.)
        $table->integer('number'); // Número de la butaca (ej. 1, 2, etc.)
        $table->enum('status', ['available', 'occupied', 'selected'])->default('available'); // Estado de la butaca
        $table->enum('type', ['normal', 'VIP'])->default('normal'); // Tipo de butaca
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
