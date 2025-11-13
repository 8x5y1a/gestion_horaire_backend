<?php

namespace Tests\Feature\contrainte;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ContrainteTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create([
            'name'=>"userTest",
            'email'=>"adresse@exemple.com",
            'password' => 'password1'
        ]);
        Sanctum::actingAs($user);
    }

    public function test_recuperer_toutes_les_contraintes(): void{
        //Effectuer la requête
        $response = $this->getJson('/api/contrainte');
        //Tester le résultat de la requête
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }
    public function test_recuperer_une_contrainte_valide(): void{
        //Effectuer la requête
        $response = $this->getJson('/api/contrainte/1');
        //Tester le résultat de la requête
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }
    public function test_recuperer_une_contrainte_invalide(): void{
        //Effectuer la requête
        $response = $this->getJson('/api/contrainte/0');
        //Tester le résultat de la requête
        $response
            ->assertStatus(404);
    }
}
