<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'seat_id',
        'price',
    ];

    // Cada entrada pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Cada entrada pertenece a una sesión
    public function session()
    {
        return $this->belongsTo(SessionMovie::class, 'session_id');
    }

    // Cada entrada está asociada a una butaca
    public function seat()
    {
        return $this->belongsTo(Seat::class, 'seat_id');
    }
}
