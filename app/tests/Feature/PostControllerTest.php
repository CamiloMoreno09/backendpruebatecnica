<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba la creación de un nuevo post
     *
     * @return void
     */
    public function test_create_post()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $data = [
            'title' => 'Nuevo Post',
            'content' => 'Este es el contenido del post.',
            'category' => 'Tecnología',
        ];

        // Realizamos la petición POST para crear un nuevo post
        $response = $this->postJson('/api/posts', $data);

        $response->assertStatus(201);

        $response->assertJson([
            'message' => 'Post creado exitosamente',
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Nuevo Post',
            'content' => 'Este es el contenido del post.',
            'category' => 'Tecnología',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Prueba la búsqueda de posts por categoría
     *
     * @return void
     */
    public function test_search_posts_by_category()
    {
        // Creamos un usuario y lo autenticamos
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        Post::factory()->create(['category' => 'Tecnología']);
        Post::factory()->create(['category' => 'Cultura']);
        Post::factory()->create(['category' => 'Tecnología']);

        // Realizamos una búsqueda por la categoría "Tecnología"
        $response = $this->getJson('/api/posts/search?search=Tecnología');

        $response->assertStatus(200);

        $response->assertJsonCount(2);  
    }

    /**
     * Prueba la obtención de todos los posts
     *
     * @return void
     */
    public function test_get_all_posts()
    {
        // Creamos algunos posts en la base de datos
        Post::factory()->create(['category' => 'Tecnología']);
        Post::factory()->create(['category' => 'Cultura']);

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200);

        $response->assertJsonCount(2);  
    }
}
