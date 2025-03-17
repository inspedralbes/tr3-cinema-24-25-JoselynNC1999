<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;


class PaymentController extends Controller
{
    public function processPayment(Request $request)
{
    $request->validate([
        'reservation_id' => 'required|exists:reservations,id',
        'amount' => 'required|numeric',
        'payment_method' => 'required|string'
    ]);

    $reservation = Reservation::findOrFail($request->reservation_id);

    // Crear el pago
    $payment = Payment::create([
        'reservation_id' => $reservation->id,
        'amount' => $request->amount,
        'status' => 'pending',
        'payment_method' => $request->payment_method,
        'transaction_id' => Str::random(10)
    ]);

    // Simulamos un pago exitoso (Aquí integrarías Stripe, PayPal, etc.)
    $payment->update(['status' => 'paid']);
    $reservation->update(['status' => 'confirmed']);

    // Cambiar el estado de los asientos a "occupied"
    foreach ($reservation->seats as $seat) {
        $seat->update(['status' => 'occupied']);
    }

    return response()->json(['message' => 'Pago exitoso', 'payment' => $payment]);
}

}
