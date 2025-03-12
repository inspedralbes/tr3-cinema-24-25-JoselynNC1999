<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SessionMovie;
use App\Models\Movie;
use Carbon\Carbon;

class SessionMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Datos de sesiones para las películas
        $sessions = [
            ['movie_id' => 1, 'date' => Carbon::now()->toDateString(), 'time' => '14:00:00', 'is_special' => false],
            ['movie_id' => 2, 'date' => Carbon::now()->addDays(1)->toDateString(), 'time' => '16:30:00', 'is_special' => true],
            ['movie_id' => 3, 'date' => Carbon::now()->addDays(2)->toDateString(), 'time' => '18:45:00', 'is_special' => false],
            ['movie_id' => 4, 'date' => Carbon::now()->addDays(3)->toDateString(), 'time' => '20:00:00', 'is_special' => false],
            ['movie_id' => 5, 'date' => Carbon::now()->addDays(4)->toDateString(), 'time' => '10:30:00', 'is_special' => true],
            ['movie_id' => 6, 'date' => Carbon::now()->addDays(5)->toDateString(), 'time' => '12:00:00', 'is_special' => false],
            ['movie_id' => 7, 'date' => Carbon::now()->addDays(6)->toDateString(), 'time' => '14:30:00', 'is_special' => false],
            ['movie_id' => 8, 'date' => Carbon::now()->addDays(7)->toDateString(), 'time' => '17:00:00', 'is_special' => true],
            ['movie_id' => 9, 'date' => Carbon::now()->addDays(8)->toDateString(), 'time' => '19:30:00', 'is_special' => false],
            ['movie_id' => 10, 'date' => Carbon::now()->addDays(9)->toDateString(), 'time' => '22:00:00', 'is_special' => false],
        ];

        // Insertar las sesiones
        foreach ($sessions as $session) {
            SessionMovie::create($session);
        }
    }
}