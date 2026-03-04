<?php

//AUTHOR: Louis Peterlini

namespace Tests\Feature\blocheure;

use App\Models\BlocHeure;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ModifierBlocHeureTest extends TestCase
{
    use DatabaseTransactions;

    private array $blocHeureData = [
        "jour"=>"Lundi",
        "heures"=>"1110000000",
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

    public function test_modifier_bloc_heure_valide(): void{
        $blocheure = BlocHeure::factory()->create();
        //Effectuer la requête
        $response = $this->putJson("/api/blocheure/{$blocheure->id}", $this->blocHeureData);
        //Tester le résultat de la requête
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }
    public function test_modifier_bloc_heure_invalide(): void{
        $blocheure = BlocHeure::factory()->create();
        $blocheure->id = -1;
        //Effectuer la requête
        $response = $this->putJson("/api/blocheure/{$blocheure->id}", $this->blocHeureData);
        //Tester le résultat de la requête
        $response
            ->assertStatus(404);
    }

    //VALIDATION : JOUR
    public function test_modifier_bloc_heure_invalide_jour_required(): void{
        $blocheure = BlocHeure::factory()->create();
        //Récupérer les données
        $blocHeureDataInvalide = $this->blocHeureData;
        //Changer pour des données invalides
        $blocHeureDataInvalide["jour"] = "";
        //Effectuer la requête
        $response = $this->putJson("/api/blocheure/{$blocheure->id}", $blocHeureDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    public function test_modifier_bloc_heure_invalide_jour_est_un_jour_de_semaine(): void{
        $blocheure = BlocHeure::factory()->create();
        //Récupérer les données
        $blocHeureDataInvalide = $this->blocHeureData;
        //Changer pour des données invalides
        $blocHeureDataInvalide["jour"] = "Test";
        //Effectuer la requête
        $response = $this->putJson("/api/blocheure/{$blocheure->id}", $blocHeureDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    //VALIDATION : HEURES
    public function test_modifier_bloc_heure_invalide_heures_required(): void{
        $blocheure = BlocHeure::factory()->create();
        //Récupérer les données
        $blocHeureDataInvalide = $this->blocHeureData;
        //Changer pour des données invalides
        $blocHeureDataInvalide["heures"] = "";
        //Effectuer la requête
        $response = $this->putJson("/api/blocheure/{$blocheure->id}", $blocHeureDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    public function test_modifier_bloc_heure_invalide_heures_regex(): void{
        $blocheure = BlocHeure::factory()->create();
        //Récupérer les données
        $blocHeureDataInvalide = $this->blocHeureData;
        //Changer pour des données invalides
        $blocHeureDataInvalide["heures"] = "Test";
        //Effectuer la requête
        $response = $this->putJson("/api/blocheure/{$blocheure->id}", $blocHeureDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
}
