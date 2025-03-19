<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'movie_id',
        'session_id',
        'seats',
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function movie()
    {
        return $this->belongsTo(Movie::class);
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
