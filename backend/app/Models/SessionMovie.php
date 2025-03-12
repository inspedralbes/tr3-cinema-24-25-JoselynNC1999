<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionMovie extends Model
{

    protected $fillable = [
        'movie_id',
        'date',
        'time',
        'is_special',
    ];

    // Cada sesión pertenece a una película
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    // Una sesión puede tener muchas butacas (seats)
    public function seats()
    {
        return $this->hasMany(Seat::class, 'session_id');
    }

    // Una sesión puede tener varias entradas (tickets)
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'session_id');
    }
}

