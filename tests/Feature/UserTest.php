<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login()
    {
        // Créer un utilisateur fictif
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);

        // Envoyer une requête POST pour se connecter
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Vérifier que la connexion est réussie (statut 200 et token reçu)
        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);
    }
}
