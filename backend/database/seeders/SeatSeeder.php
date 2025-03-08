<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seat;
use App\Models\SessionMovie;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todas las sesiones de película
        $sessions = SessionMovie::all();

        // Definir las filas y números de los asientos (esto puede cambiar según tu sala)
        $rows = ['A', 'B', 'C', 'D', 'E']; // 5 filas
        $numbers = range(1, 20); // 20 asientos por fila (1-20)

        // Crear asientos para cada sesión de película
        foreach ($sessions as $session) {
            foreach ($rows as $row) {
                foreach ($numbers as $number) {
                    Seat::create([
                        'session_id' => $session->id,  // Relacionamos el asiento con la sesión de película
                        'row' => $row,  // Fila del asiento (A, B, C, etc.)
                        'number' => $number,  // Número del asiento (1, 2, 3, etc.)
                        'status' => 'available',  // Estado inicial: disponible
                        'type' => $this->getSeatType($row),  // Tipo de asiento (normal o VIP)
                    ]);
                }
            }
        }
    }

    /**
     * Método para asignar tipo de asiento según la fila.
     * Puedes personalizar este método si deseas definir las filas VIP.
     */
    private function getSeatType($row)
    {
        // Supongamos que las filas A y B son VIP y las demás son normales.
        return in_array($row, ['A', 'B']) ? 'VIP' : 'normal';
    }
}