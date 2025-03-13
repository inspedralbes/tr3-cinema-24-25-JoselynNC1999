<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SessionMovie;
use App\Models\Movie;
use Carbon\Carbon;

class SessionMovieSeeder extends Seeder
{
    public function run()
    {
        $movies = Movie::all();

        if ($movies->isEmpty()) {
            $this->command->warn('No hay películas en la base de datos. Ejecuta primero MovieSeeder.');
            return;
        }

        $sessions = [
            ['date' => now()->addDays(1)->toDateString(), 'time' => '16:00', 'is_special' => false],
            ['date' => now()->addDays(2)->toDateString(), 'time' => '18:00', 'is_special' => false],
            ['date' => now()->addDays(3)->toDateString(), 'time' => '20:00', 'is_special' => true], // Sesión especial
        ];

        foreach ($sessions as $session) {
            SessionMovie::create([
                'movie_id'   => $movies->random()->id,
                'date'       => $session['date'],
                'time'       => $session['time'],
                'is_special' => $session['is_special'],
            ]);
        }
    }
}