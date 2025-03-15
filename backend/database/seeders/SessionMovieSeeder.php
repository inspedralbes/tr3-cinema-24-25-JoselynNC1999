<?php

namespace Database\Seeders;

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
        // Obtener todas las películas disponibles
        $movies = Movie::all();

        // Verificar que haya películas en la base de datos
        if ($movies->isEmpty()) {
            $this->command->error('No hay películas en la base de datos. Crea algunas películas primero.');
            return;
        }

        // Definir las fechas de prueba (una fecha por cada película)
        $dates = [];
        for ($i = 0; $i < $movies->count(); $i++) { // Usar el número de películas
            $dates[] = Carbon::today()->addDays($i)->toDateString();
        }

        // Horario único: 16:00
        $time = '16:00';

        // Crear sesiones para cada fecha
        foreach ($dates as $index => $date) {
            // Seleccionar una película diferente para cada fecha
            $movie = $movies[$index % $movies->count()]; // Usar módulo para evitar desbordamiento

            SessionMovie::create([
                'movie_id' => $movie->id, // ID de la película actual
                'date' => $date,
                'time' => $time,
                'is_special' => false, // Por defecto, no es una sesión especial
            ]);
        }

        // Mensaje de confirmación
        $this->command->info('Sesiones de prueba creadas correctamente.');
    }
}