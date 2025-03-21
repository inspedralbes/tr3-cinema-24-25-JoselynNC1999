<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    public function run()
    {
        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
        $seatsPerRow = 10;
        $vipRow = 'F'; // Fila VIP

        $seats = [];

        foreach ($rows as $row) {
            for ($number = 1; $number <= $seatsPerRow; $number++) {
                $seats[] = [
                    'row' => $row,
                    'number' => $number,
                    'type' => $row === $vipRow ? 'vip' : 'normal',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        DB::table('seats')->insert($seats);
    }
}
