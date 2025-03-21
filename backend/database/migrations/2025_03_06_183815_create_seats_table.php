<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->string('row'); // Letra de la fila (A, B, C, ...)
            $table->integer('number'); // Número del asiento en la fila (1, 2, 3, ...)
            $table->enum('type', ['normal', 'vip'])->default('normal'); // Tipo de asiento
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seats');
    }
};
