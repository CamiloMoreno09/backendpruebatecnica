<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Laravel\Sanctum\Sanctum;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba de registro de usuario exitoso
     *
     * @return void
     */
    public function test_register_success()
    {
        $data = [
            'email' => 'juancmoreno@ecci.edu.co',
            'password' => '12345',
        ];

        // Realizamos la petición POST para registrar un usuario
        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(201);

        // Verificamos que el mensaje sea correcto
        $response->assertJson([
            'message' => 'Usuario creado exitosamente',
        ]);

        // Verificamos que el usuario haya sido creado en la base de datos
        $this->assertDatabaseHas('usuarios', [
            'email' => 'user@example.com',
        ]);
    }

    /**
     * Prueba de login exitoso
     *
     * @return void
     */
    public function test_login_success()
    {
        // Creamos un usuario para autenticar
        $usuario = Usuario::factory()->create([
            'password' => Hash::make('12345'),
        ]);

        $data = [
            'email' => $usuario->email,
            'password' => '12345',
        ];

        // Realizamos la petición POST para hacer login
        $response = $this->postJson('/api/login', $data);

        // Verificamos que la respuesta sea un código de éxito
        $response->assertStatus(200);

        // Verificamos que la respuesta contenga el token
        $response->assertJsonStructure([
            'message',
            'token',
        ]);
    }

    /**
     * Prueba de login fallido (credenciales incorrectas)
     *
     * @return void
     */
    public function test_login_failed()
    {
        $data = [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ];

        $response = $this->postJson('/api/login', $data);

        $response->assertStatus(401);

        $response->assertJson([
            'error' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    /**
     * Prueba de logout exitoso
     *
     * @return void
     */
    public function test_logout_success()
    {
        $usuario = Usuario::factory()->create([
            'password' => Hash::make('12345'),
        ]);
        
        Sanctum::actingAs($usuario);

        // Realizamos la petición POST para hacer logout
        $response = $this->postJson('/api/logout');

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Usuario desconectado correctamente',
        ]);

        $this->assertCount(0, $usuario->tokens);
    }
}
