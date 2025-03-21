<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function session()
    {
        return $this->belongsTo(SessionMovie::class);
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
