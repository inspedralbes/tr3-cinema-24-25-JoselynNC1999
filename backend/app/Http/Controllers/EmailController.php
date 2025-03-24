<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendTicketEmail(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'session_id' => 'required|integer',
            'movie_title' => 'required|string',
            'date' => 'required|string',
            'time' => 'required|string',
            'room' => 'required|string',
            'seats' => 'required|array',
            'total_price' => 'required|numeric',
            'email' => 'required|email',
        ]);

        // Generar PDF
        $pdf = Pdf::loadView('emails.ticket', $data);

        // Enviar correo
        Mail::send('emails.ticket', $data, function ($message) use ($data, $pdf) {
            $message->to($data['email'])
                    ->subject('Confirmació de la reserva')
                    ->attachData($pdf->output(), 'ticket.pdf');
        });

        return response()->json(['message' => 'Correo enviado con éxito']);
    }
}