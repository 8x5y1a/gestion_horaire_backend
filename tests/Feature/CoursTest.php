<?php

//AUTHOR: Mathieu Lahaie-Richer

use App\Models\Cheminement;
use App\Models\Cours;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * @author Mathieu Lahaie-Richer
 */
class CoursTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Méthode qui permet d'initialiser des données pour la série de test.
     * @return void
     */
    public function setUp():void{

        parent::setUp();

        $user = User::factory()->create();
        $role = Role::find(1);
        $user->role()->attach($role);
        Sanctum::actingAs($user);

    }
    public function test_liste_cours(){

        $response = $this->getJson('/api/cours');

        $response->assertOk();
        $response->assertJsonCount(1);
    }

    public function test_ajout_cours_valid(){

        $cheminement1 = Cheminement::factory()->createOne();
        $cheminement2 = Cheminement::factory()->createOne();

        //Création objet
        $requete = [
          'code' => "340-HUH-HH",
          'nom' => "Logique de programmation",
          'ponderation' => "3-3-3",
          'bloc' => "3-3",
          'cours_charge' => 1,
          'local_technique' => 1,
          'session' => 1,
          'cheminement' => [$cheminement1->id,$cheminement2->id]
        ];

        //Valider qu'il ne se trouve pas déjà dans la base de données.
        $this->assertDatabaseMissing('cours', [
            'code' => $requete['code'],
            'nom' => $requete['nom'],
            'ponderation' => $requete['ponderation'],
            'bloc' => $requete['bloc'],
            'cours_charge' => $requete['cours_charge'],
            'local_technique' => $requete['local_technique'],
            'session' => $requete['session'],
        ]);

        //Requête pour créer le cours.
        $response = $this->postJson('/api/cours', $requete);

        $response->assertStatus(200);

        //Valider qu'il se trouve dans la base de données après la demande de création.
        $this->assertDatabaseHas('cours', [
            'code' => $requete['code'],
            'nom' => $requete['nom'],
            'ponderation' => $requete['ponderation'],
            'bloc' => $requete['bloc'],
            'cours_charge' => $requete['cours_charge'],
            'local_technique' => $requete['local_technique'],
            'session' => $requete['session'],
        ]);
    }

    public function test_ajouter_cours_invalid(){

        $cheminement1 = Cheminement::factory()->createOne();
        $cheminement2 = Cheminement::factory()->createOne();

        //Création du cours avec une pondération invalide.
        $requete = [
            'code' => "370-HUH-HH",
            'nom' => "Logique de programmation",
            'ponderation' => "3-3",
            'bloc' => "3-3",
            'cours_charge' => 1,
            'local_technique' => 1,
            'session' => 1,
            'cheminement' => [$cheminement1->id,$cheminement2->id]
        ];

        //Valider qu'il ne se trouve pas déjà dans la base de données.
        $this->assertDatabaseMissing('cours', [
            'code' => $requete['code'],
            'nom' => $requete['nom'],
            'ponderation' => $requete['ponderation'],
            'bloc' => $requete['bloc'],
            'cours_charge' => $requete['cours_charge'],
            'local_technique' => $requete['local_technique'],
            'session' => $requete['session'],
        ]);

        //Requête pour créer le cours.
        $response = $this->postJson('/api/cours', $requete);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors('ponderation');
    }

    public function test_suppression_cours_valid() : void{

        $cheminement = Cheminement::factory()->createOne();
        $cours = Cours::factory()->createOne();
        $cours->cheminement()->attach($cheminement);

        $response = $this->deleteJson("/api/cours/{$cours->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('cours',['id' => $cours->id]);
    }

    public function test_modification_cours_valid():void{

        $cheminement1 = Cheminement::factory()->createOne();
        $cheminement2 = Cheminement::factory()->createOne();

        $cours = Cours::factory()->create();

        $requete = [
            'code' => "340-HUH-HH",
            'nom' => "TestValid",
            'ponderation' => "3-3-3",
            'bloc' => "3-3",
            'cours_charge' => 0,
            'local_technique' => 0,
            'session' => 5,
            'cheminement' => [$cheminement2->id,$cheminement1->id]
        ];

        //Requête pour modifier le cours.
        $response = $this->Json('PUT',"/api/cours/{$cours->id}",$requete);

        $response->assertStatus(200);

        //Valider le cours modifié est dans base de données.
        $this->assertDatabaseHas('cours', [
            'code' => $requete['code'],
            'nom' => $requete['nom'],
            'ponderation' => $requete['ponderation'],
            'bloc' => $requete['bloc'],
            'cours_charge' => $requete['cours_charge'],
            'local_technique' => $requete['local_technique'],
            'session' => $requete['session'],
        ]);
    }

    public function test_modification_cours_invalid():void{

        $cheminement1 = Cheminement::factory()->createOne();
        $cheminement2 = Cheminement::factory()->createOne();

        $cours = Cours::factory()->create();

        //Pondération invalide
        $requete = [
            'code' => "340-HUH-HH",
            'nom' => "TestValid",
            'ponderation' => "3-3",
            'bloc' => "3-3",
            'cours_charge' => 0,
            'local_technique' => 0,
            'session' => 5,
            'cheminement' => [$cheminement2->id,$cheminement1->id]
        ];

        //Requête pour modifier le cours.
        $response = $this->json('PUT','/api/cours/'. $cours->id,$requete);

        $response->assertStatus(422);

        //Valider le cours modifié est dans base de données.
        $this->assertDatabaseMissing('cours', [
            'code' => $requete['code'],
            'nom' => $requete['nom'],
            'ponderation' => $requete['ponderation'],
            'bloc' => $requete['bloc'],
            'cours_charge' => $requete['cours_charge'],
            'local_technique' => $requete['local_technique'],
            'session' => $requete['session'],
        ]);
    }
}
