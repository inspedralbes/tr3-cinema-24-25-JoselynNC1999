<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'description',
        'poster_url',
        'duration',
    ];

    // Una película puede tener muchas sesiones
    public function sessions()
    {
        return $this->hasMany(SessionMovie::class, 'movie_id');
    }
}