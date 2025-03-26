<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin User', 'email' => 'admin@example.com', 'phone' => '123456789', 'password' => 'password'],
            ['name' => 'John Doe', 'email' => 'johndoe@example.com', 'phone' => '987654321', 'password' => 'password123'],
            ['name' => 'Jane Smith', 'email' => 'janesmith@example.com', 'phone' => '111222333', 'password' => 'password123'],
            ['name' => 'Michael Brown', 'email' => 'michael@example.com', 'phone' => '444555666', 'password' => 'password123'],
            ['name' => 'Emily Johnson', 'email' => 'emily@example.com', 'phone' => '777888999', 'password' => 'password123'],
            ['name' => 'Chris Evans', 'email' => 'chris@example.com', 'phone' => '333444555', 'password' => 'password123'],
            ['name' => 'Natalie Portman', 'email' => 'natalie@example.com', 'phone' => '666777888', 'password' => 'password123'],
            ['name' => 'Robert Downey', 'email' => 'robert@example.com', 'phone' => '999000111', 'password' => 'password123'],
            ['name' => 'Scarlett Johansson', 'email' => 'scarlett@example.com', 'phone' => '222333444', 'password' => 'password123'],
            ['name' => 'Tom Holland', 'email' => 'tom@example.com', 'phone' => '555666777', 'password' => 'password123'],
        ];

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '123456789',
            'password' => Hash::make('password'), // Contraseña encriptada
            'is_admin' => 1, // Definir que este usuario es administrador
        ]);

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'password' => Hash::make($user['password']), // Encripta la contraseña
                'is_admin' => 0, // Definir que estos usuarios son normales
            ]);
        }
    }
}