<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    public function run()
    {
        // Obtener todas las sesiones disponibles
        $sessions = DB::table('session_movies')->get();

        // Comprobar si hay al menos una sesión
        if ($sessions->isEmpty()) {
            echo "No hay sesiones para asociar los asientos.";
            return;
        }

        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
        $seatsPerRow = 10;
        $vipRow = 'F'; // Fila VIP

        // Se van a generar los asientos para cada sesión
        foreach ($sessions as $session) {
            $seats = [];

            foreach ($rows as $row) {
                for ($number = 1; $number <= $seatsPerRow; $number++) {
                    $seats[] = [
                        'session_id' => $session->id, // Asociamos el asiento a la sesión actual
                        'row' => $row,
                        'number' => $number,
                        'type' => $row === $vipRow ? 'vip' : 'normal',
                        'status' => false, // Estado por defecto (asiento libre)
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }

            // Insertar los asientos para la sesión actual
            DB::table('seats')->insert($seats);
        }
    }
}