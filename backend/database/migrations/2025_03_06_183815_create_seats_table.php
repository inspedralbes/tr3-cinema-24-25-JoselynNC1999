<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id'); 
            $table->foreign('session_id')->references('id')->on('session_movies')->onDelete('cascade'); // Corregido
            $table->string('row');
            $table->integer('number');
            $table->boolean('status')->default(false);
            $table->string('type');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('seats');
    }
};
