<?php

//AUTHOR: Louis Peterlini

namespace Tests\Feature\contrainte;

use App\Models\User;
use App\Models\Role;
use App\Models\Contrainte;
use Database\Factories\ContrainteFactory;
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
            'nom'=>"userTest",
            'email'=>"adresse@exemple.com",
            'password' => 'password1'
        ]);
        $role = Role::find(1);
        $user->role()->attach($role);
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
        $contrainte = Contrainte::factory()->create();
        //Effectuer la requête
        $response = $this->getJson("/api/contrainte/{$contrainte->id}");
        //Tester le résultat de la requête
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }
    public function test_recuperer_une_contrainte_invalide(): void{
        $contrainte = Contrainte::factory()->create();
        $contrainte->id = -1;
        //Effectuer la requête
        $response = $this->getJson("/api/contrainte/{$contrainte->id}");
        //Tester le résultat de la requête
        $response
            ->assertStatus(404);
    }
}
