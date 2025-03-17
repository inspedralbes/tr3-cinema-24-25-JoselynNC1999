<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movie_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('movie_title');
            $table->string('cinema_room');
            $table->dateTime('showtime');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movie_sessions');
    }
};