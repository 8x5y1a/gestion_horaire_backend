<?php


use App\Models\Cheminement;
use App\Models\Contrainte;
use App\Models\Cours;
use App\Models\Horaire;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
/**
 * @author Mathieu Lahaie-Richer
 */
class CheminementTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Méthode qui permet d'initialiser des données pour la série de test.
     * @return void
     */
    public function setUp():void{

        parent::setUp();
        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }

    public function test_liste_cheminements(){

        $response = $this->getJson('/api/cheminement');

        $response->assertOk();
    }
    public function test_ajout_cheminement_valid(){

        $cours1 = Cours::factory()->createOne();
        $cours2 = Cours::factory()->createOne();
        $contrainte1 = Contrainte::factory()->createOne();
        $contrainte2 = Contrainte::factory()->createOne();
        $horaire = Horaire::factory()->createOne();

        $cheminement = [
            'option' => "Programmation",
            'nom' => "Technique de l'informatique",
            'horaire_id' => $horaire->id,
        ];

        $requete = [
            'option' => "Programmation",
            'nom' => "Technique de l'informatique",
            'horaire_id' => $horaire->id,
            'cours' => [$cours1->id,$cours2->id],
            'contraintes' => [$contrainte1->id,$contrainte2->id]
        ];

        $this->assertDatabaseMissing('cheminements',$cheminement);

        $response = $this->postJson('/api/cheminement',$requete);

        $response->assertOk();

        $this->assertDatabaseHas('cheminements', $cheminement);
    }
    public function test_ajout_cheminement_invalid(){

        $cours1 = Cours::factory()->createOne();
        $cours2 = Cours::factory()->createOne();
        $contrainte1 = Contrainte::factory()->createOne();
        $contrainte2 = Contrainte::factory()->createOne();
        $horaire = Horaire::factory()->createOne();

        $cheminement = [
            'option' => "Programmation",
            'nom' => "Technique de l'informatique",
            'horaire_id' => $horaire->id,
        ];

        $requete = [
            'option' => "Programmation",
            'nom' => null,
            'horaire_id' => $horaire->id,
            'cours' => [$cours1->id,$cours2->id],
            'contraintes' => [$contrainte1->id,$contrainte2->id]
        ];

        $this->assertDatabaseMissing('cheminements',$cheminement);

        $response = $this->postJson('/api/cheminement',$requete);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('cheminements',$cheminement);
    }
    public function test_suppression_cheminement_valid(){

        $cheminement = Cheminement::factory()->createOne();
        $cour = Cours::factory()->createOne();
        $cour->cheminement()->attach($cheminement);

        $response = $this->deleteJson('/api/cheminement/' . $cheminement->id);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('cheminements',['id' => $cheminement->id]);
    }

    public function test_modification_cours_valid(){

        $cours1 = Cours::factory()->createOne();
        $cours2 = Cours::factory()->createOne();
        $contrainte1 = Contrainte::factory()->createOne();
        $contrainte2 = Contrainte::factory()->createOne();
        $horaire = Horaire::factory()->createOne();

        $cheminement = Cheminement::factory()->createOne();

        $requete = [
            'option' => "Programmation",
            'nom' => "Technique informatique",
            'horaire_id' => $horaire->id,
            'cours' => [$cours1->id,$cours2->id],
            'contraintes' => [$contrainte1->id,$contrainte2->id]
        ];

        $response = $this->putJson('/api/cheminement/'. $cheminement->id,$requete);

        $response->assertOk();

        $this->assertDatabaseHas('cheminements', [
            'id' => $cheminement->id,
            'option' => $requete['option'],
            'nom' => $requete['nom'],
            'horaire_id' => $requete['horaire_id'],
        ]);
    }
    public function test_modification_cours_invalid(){

        $cours1 = Cours::factory()->createOne();
        $cours2 = Cours::factory()->createOne();
        $contrainte1 = Contrainte::factory()->createOne();
        $contrainte2 = Contrainte::factory()->createOne();
        $horaire = Horaire::factory()->createOne();

        $cheminement = Cheminement::factory()->createOne();

        $requete = [
            'option' => "Programmation",
            'nom' => null,
            'horaire_id' => $horaire->id,
            'cours' => [$cours1->id,$cours2->id],
            'contraintes' => [$contrainte1->id,$contrainte2->id]
        ];

        $response = $this->putJson('/api/cheminement/'. $cheminement->id,$requete);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('cheminements', [
            'id' => $cheminement->id,
            'option' => $requete['option'],
            'nom' => $requete['nom'],
            'horaire_id' => $requete['horaire_id'],
        ]);
    }
}
