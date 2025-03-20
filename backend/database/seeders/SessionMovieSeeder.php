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

        // Establecer el día de hoy
        $today = Carbon::today(); // Obtiene la fecha de hoy en el momento de ejecución

        // Crear sesiones para cada película con días continuos
        for ($i = 0; $i < $movies->count(); $i++) { // Usar el número de películas
            $date = $today->copy()->addDays($i); // Usamos copy() para no modificar la variable $today original

            // Seleccionar una película diferente para cada fecha
            $movie = $movies[$i % $movies->count()]; // Usar índice directamente para evitar desbordamiento

            // Crear la sesión
            SessionMovie::create([
                'movie_id' => $movie->id, // ID de la película actual
                'date' => $date->toDateString(), // Convertir la fecha a formato de string
                'time' => '16:00',
                'is_special' => false, // Por defecto, no es una sesión especial
            ]);
        }

        // Mensaje de confirmación
        $this->command->info('Sesiones de prueba creadas correctamente.');
    }
}