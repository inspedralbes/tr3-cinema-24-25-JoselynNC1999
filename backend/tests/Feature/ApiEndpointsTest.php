<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ApiEndpointsTest extends TestCase
{
    use RefreshDatabase;

    // 🟢 Pruebas para autenticación
    public function test_register_endpoint()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['user', 'token']);
    }

    public function test_login_endpoint()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);
    }

    // 🟢 Pruebas para rutas públicas
    public function test_get_seats_endpoint()
    {
        $response = $this->getJson('/api/seats');
        $response->assertStatus(200)
                 ->assertJsonStructure(['data']);
    }
}
