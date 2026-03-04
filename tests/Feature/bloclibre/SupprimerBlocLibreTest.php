<?php

//AUTHOR: Louis Peterlini

namespace Tests\Feature\bloclibre;

use App\Models\BlocLibre;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SupprimerBlocLibreTest extends TestCase
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

    public function test_supprimer_bloc_libre(): void{
        $bloclibre = BlocLibre::factory()->create();
        //Effectuer la requête
        $response = $this->deleteJson("/api/bloclibre/{$bloclibre->id}");
        //Tester le résultat de la requête
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }
}
