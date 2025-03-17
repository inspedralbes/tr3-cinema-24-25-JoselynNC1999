<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade'); // Relación con reservations
            $table->decimal('amount', 8, 2); // Precio total
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending'); // Estado del pago
            $table->string('payment_method'); // Método de pago (ej. tarjeta, PayPal)
            $table->string('transaction_id')->nullable(); // ID de la transacción
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
