<?php

namespace Tests\Feature\bloclibre;

use App\Models\User;
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
            'name'=>"userTest",
            'email'=>"adresse@exemple.com",
            'password' => 'password1'
        ]);
        Sanctum::actingAs($user);
    }

    public function test_supprimer_bloc_libre(): void{
        //Effectuer la requête
        $response = $this->deleteJson('/api/bloclibre/1');
        //Tester le résultat de la requête
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }
}
