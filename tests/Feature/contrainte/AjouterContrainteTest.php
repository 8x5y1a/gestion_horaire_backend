<?php

//AUTHOR: Louis Peterlini

namespace Tests\Feature\contrainte;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AjouterContrainteTest extends TestCase
{
    use DatabaseTransactions;

    private array $contrainteData = [
        "nom"=>"ContrainteTest",
        "description"=>"ContrainteTest",
        "type"=>"autre",
        "precision"=>"autreContrainte",
        "stricte"=>0,
        "session"=>1,
        "enseignants"=>[1,2],
        "cours"=>[1,2],
        "ls_blocs_heures"=>[["jour"=>"Lundi", "heures"=>"1110000000"], ["jour"=>"Vendredi", "heures"=>"1110000000"],],
        "ls_blocs_libres"=>[["nb_bloc"=>1, "nb_heure"=>2], ["nb_bloc"=>2, "nb_heure"=>3],]
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

    public function test_ajouter_contrainte_valide(): void{
        //Effectuer la requête
        $response = $this->postJson('/api/contrainte', $this->contrainteData);
        //Tester le résultat de la requête
        $response
            ->assertStatus(201)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }
    //VALIDATION : NOM
    public function test_ajouter_contrainte_invalide_nom_required(): void{
        //Récupérer les données
        $contrainteDataInvalide = $this->contrainteData;
        //Changer pour des données invalides
        $contrainteDataInvalide["nom"] = "";
        //Effectuer la requête
        $response = $this->postJson('/api/contrainte', $contrainteDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    public function test_ajouter_contrainte_invalide_nom_maxlength_50(): void{
        //Récupérer les données
        $contrainteDataInvalide = $this->contrainteData;
        //Changer pour des données invalides
        $contrainteDataInvalide["nom"] = str_repeat("A", 51);
        //Effectuer la requête
        $response = $this->postJson('/api/contrainte', $contrainteDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    //VALIDATION : DESCRIPTION
    public function test_ajouter_contrainte_invalide_description_maxlength_250(): void{
        //Récupérer les données
        $contrainteDataInvalide = $this->contrainteData;
        //Changer pour des données invalides
        $contrainteDataInvalide["description"] = str_repeat("A", 251);
        //Effectuer la requête
        $response = $this->postJson('/api/contrainte', $contrainteDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    //VALIDATION : TYPE
    public function test_ajouter_contrainte_invalide_type_required(): void{
        //Récupérer les données
        $contrainteDataInvalide = $this->contrainteData;
        //Changer pour des données invalides
        $contrainteDataInvalide["type"] = null;
        //Effectuer la requête
        $response = $this->postJson('/api/contrainte', $contrainteDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    public function test_ajouter_contrainte_invalide_type_description_maxlength_50(): void{
        //Récupérer les données
        $contrainteDataInvalide = $this->contrainteData;
        //Changer pour des données invalides
        $contrainteDataInvalide["type_description"] = str_repeat("A", 51);
        //Effectuer la requête
        $response = $this->postJson('/api/contrainte', $contrainteDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    //VALIDATION : STRICTE
    public function test_ajouter_contrainte_invalide_stricte_required(): void{
        //Récupérer les données
        $contrainteDataInvalide = $this->contrainteData;
        //Changer pour des données invalides
        $contrainteDataInvalide["stricte"] = null;
        //Effectuer la requête
        $response = $this->postJson('/api/contrainte', $contrainteDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    public function test_ajouter_contrainte_invalide_stricte_boolean(): void{
        //Récupérer les données
        $contrainteDataInvalide = $this->contrainteData;
        //Changer pour des données invalides
        $contrainteDataInvalide["stricte"] = "string";
        //Effectuer la requête
        $response = $this->postJson('/api/contrainte', $contrainteDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    //VALIDATION : SESSION
    public function test_ajouter_contrainte_invalide_session_required_quand_type_est_generaux(): void{
        //Récupérer les données
        $contrainteDataInvalide = $this->contrainteData;
        //Changer pour des données invalides
        $contrainteDataInvalide["type"] = "generaux";
        $contrainteDataInvalide["session"] = null;
        //Effectuer la requête
        $response = $this->postJson('/api/contrainte', $contrainteDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    public function test_ajouter_contrainte_invalide_session_integer(): void{
        //Récupérer les données
        $contrainteDataInvalide = $this->contrainteData;
        //Changer pour des données invalides
        $contrainteDataInvalide["session"] = "string";
        //Effectuer la requête
        $response = $this->postJson('/api/contrainte', $contrainteDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    public function test_ajouter_contrainte_invalide_session_min_0(): void{
        //Récupérer les données
        $contrainteDataInvalide = $this->contrainteData;
        //Changer pour des données invalides
        $contrainteDataInvalide["session"] = -1;
        //Effectuer la requête
        $response = $this->postJson('/api/contrainte', $contrainteDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
    public function test_ajouter_contrainte_invalide_session_max_6(): void{
        //Récupérer les données
        $contrainteDataInvalide = $this->contrainteData;
        //Changer pour des données invalides
        $contrainteDataInvalide["session"] = 7;
        //Effectuer la requête
        $response = $this->postJson('/api/contrainte', $contrainteDataInvalide);
        //Tester le résultat de la requête
        $response
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) => $json->has('message')->has('errors'));
    }
}
