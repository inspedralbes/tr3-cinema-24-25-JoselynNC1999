<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Movie extends Model
{
    use HasFactory;
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