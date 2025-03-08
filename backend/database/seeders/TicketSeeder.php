<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;
use App\Models\SessionMovie;
use App\Models\Seat;
use Faker\Factory as Faker;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usar Faker para generar precios aleatorios (esto es opcional)
        $faker = Faker::create();

        // Obtener algunos usuarios, sesiones y asientos
        $users = User::all();
        $sessions = SessionMovie::all();
        $seats = Seat::all();

        // Verificar que haya datos suficientes para evitar errores
        if ($users->isEmpty() || $sessions->isEmpty() || $seats->isEmpty()) {
            echo "Asegúrate de que hay usuarios, sesiones y asientos en la base de datos.\n";
            return;
        }

        // Crear tickets (ejemplo de 50 tickets)
        foreach (range(1, 50) as $index) {
            // Seleccionar un usuario, una sesión y un asiento aleatoriamente
            $user = $users->random();
            $session = $sessions->random();
            $seat = $seats->where('session_id', $session->id)->random(); // Obtener asiento de la misma sesión

            // Crear un ticket con un precio aleatorio entre 5 y 15
            Ticket::create([
                'user_id' => $user->id,
                'session_id' => $session->id,
                'seat_id' => $seat->id,
                'price' => $faker->randomFloat(2, 5, 15), // Precio aleatorio entre 5 y 15
            ]);
        }
    }
}
