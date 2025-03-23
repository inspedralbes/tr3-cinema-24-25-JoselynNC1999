<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',  // Agrega este campo
        'session_id', // Agrega este campo
        'status' // Agrega este campo
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function session()
    {
        return $this->belongsTo(SessionMovie::class, 'session_id');
    }

    public function seats()
    {
        return $this->belongsToMany(Seat::class, 'reservation_seat');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
