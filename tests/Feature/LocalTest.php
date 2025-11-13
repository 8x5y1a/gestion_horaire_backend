<?php

namespace Tests\Feature;

use App\Models\Local;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LocalTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Fonction qui permet de préparer les données des tests.
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();


        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }

    /**
     * Fonction qui permet de vérifier que la création d'un local avec des données valides fonctionne.
     * @return void
     */
    public function test_creer_local(): void {
        $local = $this->postJson('/api/local', [
            'no_local' => '1.02',
            'capacite' => 20,
            'local_technique' => True,
        ]);
        $local->assertStatus(200)->assertJson(fn(AssertableJson $json)=> $json->has('data'));
    }

    /**
     * Fonction qui permet de vérifier que la création d'un local avec des données invalides.
     * @return void
     */
    public function test_creer_local_invalide(): void {
        $local = $this->postJson('/api/local', [
            'no_local' => '',
            'capacite' => 0,
            'local_technique' => null,
        ]);
        $local->assertStatus(422)->assertJsonValidationErrors(['no_local', 'capacite', 'local_technique']);
    }

    /** Fonction qui permet de vérifier que la modification d'un local avec données valides fonctionne.
     * @return void
     */
    public function test_modifier_local(): void {
        //Générer un local et créer des données de modification
        $local = Local::factory()->create();
        $nouvellesDonnees = [
            'no_local' => '1.02',
            'capacite' => 20,
            'local_technique' => True,
        ];

        //Modifié le local
        $localModifie = $this->json('PUT', "/api/local/{$local->id}", $nouvellesDonnees);

        //Vérifier la modification
        $localModifie->assertStatus(200);
        $localModifie->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'no_local',
                    'capacite',
                    'local_technique',
                ]
            ]
        ]);

        $localModifie = Local::findOrFail($local->id);
        $this->assertEquals($localModifie->no_local, $nouvellesDonnees['no_local']);
        $this->assertEquals($localModifie->capacite, $nouvellesDonnees['capacite']);
        $this->assertEquals($localModifie->local_technique, $nouvellesDonnees['local_technique']);
    }

    /**
     * Fonction qui permet de vérifier la modification d'un local invalide.
     * @return void
     */
    public function test_modifier_local_invalide(): void{

        //Générer un local et créer des données de modification
        $local = Local::factory()->create();
        $nouvellesDonnees = [
            'no_local' => '',
            'capacite' => 0,
            'local_technique' => null,
        ];

        //Modifier le local et vérifier s'il est invalide.
        $localModifie = $this->json('PUT', "/api/local/{$local->id}", $nouvellesDonnees);
        $localModifie->assertStatus(422)->assertJsonValidationErrors(['no_local', 'capacite', 'local_technique']);
    }

    /**
     * Fonction qui permet de vérifier la suppression d'un local.
     * @return void
     */
    public function test_supprimer_local(): void {

        //Générer un local
        $local = Local::factory()->create();

        //Supprimer le local
        $suppression = $this->deleteJson("/api/local/{$local->id}");

        //Vérifier qu'il a été supprimer
        $suppression->assertStatus(200);
        $suppression->assertJsonMissing([
            'data' => [
                'id' => $local->id
            ]
        ]);
        $this->assertDatabaseMissing('locaux', ['id' => $local->id]);
    }

    /**
     * Fonction qui permet de vérifier la suppression d'un local invalide.
     * @return void
     */
    public function test_supprimer_local_invalide(): void {

        $suppression = $this->deleteJson('api/local/-3');
        $suppression->assertStatus(404);
    }

}
