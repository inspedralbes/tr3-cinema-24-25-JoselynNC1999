<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'session_id',
        'row',
        'number',
        'status',
        'type',
    ];

    // Cada butaca pertenece a una sesión
    public function session()
    {
        return $this->belongsTo(SessionMovie::class, 'session_id');
    }

    // Opcional: si deseas relacionar la butaca con su ticket (una butaca puede tener un ticket activo)
    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'seat_id');
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_seat');
    }
}
