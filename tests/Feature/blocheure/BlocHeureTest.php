<?php

namespace Tests\Feature\blocheure;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BlocHeureTest extends TestCase
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

    public function test_recuperer_tous_les_blocs_heures(): void{
        //Effectuer la requête
        $response = $this->getJson('/api/blocheure');
        //Tester le résultat de la requête
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }
    public function test_recuperer_un_bloc_heure(): void{
        //Effectuer la requête
        $response = $this->getJson('/api/blocheure/1');
        //Tester le résultat de la requête
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }
}
