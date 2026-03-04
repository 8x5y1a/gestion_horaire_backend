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

class ModifierBlocLibreTest extends TestCase
{
    use DatabaseTransactions;

    private array $blocLibreData = [
        "nb_bloc"=>1,
        "nb_heure"=>1,
        "contrainte_id"=>1
    ];

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

    public function test_modifier_bloc_libre_valide(): void{
        $bloclibre = BlocLibre::factory()->create();
        //Effectuer la requête
        $response = $this->putJson("/api/bloclibre/{$bloclibre->id}", $this->blocLibreData);
        //Tester le résultat de la requête
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }
    public function test_modifier_bloc_libre_invalide(): void{
        $bloclibre = BlocLibre::factory()->create();
        $bloclibre->id = -1;
        //Effectuer la requête
        $response = $this->putJson("/api/bloclibre/{$bloclibre->id}", $this->blocLibreData);
        //Tester le résultat de la requête
        $response
            ->assertStatus(404);
    }

    //VALIDATION : NB_BLOC
    public function test_modifier_bloc_libre_invalide_nb_bloc_required(): void{
        $bloclibre = BlocLibre::factory()->create();
        //Récupérer les données
        $blocLibreDataInvalide = $this->blocLibreData;
        //Changer pour des données invalides
        $blocLibreDataInvalide["nb_bloc"] = null;
        //Effectuer la requête
        $response = $this->putJson("/api/bloclibre/{$bloclibre->id}", $blocLibreDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    public function test_modifier_bloc_libre_invalide_nb_bloc_integer(): void{
        $bloclibre = BlocLibre::factory()->create();
        //Récupérer les données
        $blocLibreDataInvalide = $this->blocLibreData;
        //Changer pour des données invalides
        $blocLibreDataInvalide["nb_bloc"] = "Test";
        //Effectuer la requête
        $response = $this->putJson("/api/bloclibre/{$bloclibre->id}", $blocLibreDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    public function test_modifier_bloc_libre_invalide_nb_bloc_min_1(): void{
        $bloclibre = BlocLibre::factory()->create();
        //Récupérer les données
        $blocLibreDataInvalide = $this->blocLibreData;
        //Changer pour des données invalides
        $blocLibreDataInvalide["nb_bloc"] = 0;
        //Effectuer la requête
        $response = $this->putJson("/api/bloclibre/{$bloclibre->id}", $blocLibreDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    //VALIDATION : NB_HEURE
    public function test_modifier_bloc_libre_invalide_nb_heure_required(): void{
        $bloclibre = BlocLibre::factory()->create();
        //Récupérer les données
        $blocLibreDataInvalide = $this->blocLibreData;
        //Changer pour des données invalides
        $blocLibreDataInvalide["nb_heure"] = null;
        //Effectuer la requête
        $response = $this->putJson("/api/bloclibre/{$bloclibre->id}", $blocLibreDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    public function test_modifier_bloc_libre_invalide_nb_heure_integer(): void{
        $bloclibre = BlocLibre::factory()->create();
        //Récupérer les données
        $blocLibreDataInvalide = $this->blocLibreData;
        //Changer pour des données invalides
        $blocLibreDataInvalide["nb_heure"] = "Test";
        //Effectuer la requête
        $response = $this->putJson("/api/bloclibre/{$bloclibre->id}", $blocLibreDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    public function test_modifier_bloc_libre_invalide_nb_heure_min_1(): void{
        $bloclibre = BlocLibre::factory()->create();
        //Récupérer les données
        $blocLibreDataInvalide = $this->blocLibreData;
        //Changer pour des données invalides
        $blocLibreDataInvalide["nb_heure"] = 0;
        //Effectuer la requête
        $response = $this->putJson("/api/bloclibre/{$bloclibre->id}", $blocLibreDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
}
