<?php

//AUTHOR: Louis-Carl Proulx

namespace Tests\Feature;

use App\Models\BlocCours;
use App\Models\Campus;
use App\Models\Cours;
use App\Models\Horaire;
use App\Models\Jour;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use App\Models\Local;
use App\Models\GroupeCours;
class BlocCoursTest extends TestCase
{


    use DatabaseTransactions;
    public function setUp(): void
    {
        parent::setUp();

        $campus = Campus::create(['nom' => 'un nom de campus']);
        $user = User::factory()->create();
        $role = Role::find(1);
        $user->role()->attach($role);
        $cours = Cours::factory()->create();
        $this->seed(\Database\Seeders\CampusSeeder::class);

        $this->userId = $user->id;
        $this->coursId = $cours->id;
        $this->campusId = $campus->id;

        GroupeCours::factory()->create();

        Sanctum::actingAs($user);
    }


    //section index

    public function test_index_retourne_donnee_dans_un_format_valid(): void
    {
        // Arrange
        $horaire = Horaire::factory()->create();
        $local = Local::factory()->create([
            'horaire_id' => $horaire->id,
        ]);

        $groupeCours = GroupeCours::factory()->create([
            'campus_id' => $this->campusId,
            'user_id' => $this->userId,
            'cours_id' => $this->coursId,
        ]);

        BlocCours::factory()->count(2)->create([
            'local_id' => $local->id,
            'groupe_cours_id' => $groupeCours->id,
        ]);
        //Act
        $response = $this->getJson('/api/bloccours');

        //assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [ //Regarde si c un array
                    'id',
                    'jour',
                    'heures',
                    'groupe_cours',
                    'local'
                ]
            ]
        ]);

    }


    //section Store
    public function test_creer_bloc_cours(): void
    {
        //Récupérer le nombre de blocs cours -> SOURCE: Valérie Levasseur https://gitlab.com/420-CO/cours/projet-a23/horaires/laravel_api/-/issues/8
        $count_avant = BlocCours::all()->count();
        // Arrange
        $horaire = Horaire::factory()->create();
        $local = Local::factory()->create([
            'horaire_id' => $horaire->id,
        ]);

        $groupeCours = GroupeCours::factory()->create([
            'campus_id' => $this->campusId,
            'user_id' => $this->userId,
            'cours_id' => $this->coursId,
        ]);


        // Act
        $response = $this->postJson('/api/bloccours', [
            'local_id' => $local->id,
            'groupe_cours_id' => $groupeCours->id,
            'jour' => 'Lundi',
            'heures' => '1111000000',
            'dure' => 2
        ]);


        // Assert
        $response->assertStatus(200);
        $this->assertCount($count_avant+1, BlocCours::all());
        $response->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }
    public function test_store_bloc_cours_sans_local_invalide(): void
    {

        $groupeCours = GroupeCours::factory()->create([
            'campus_id' => $this->campusId,
            'user_id' => $this->userId,
            'cours_id' => $this->coursId,
        ]);

        $localIdInvalide = 999;

        $response = $this->postJson('/api/bloccours', [
            'local_id' => $localIdInvalide,
            'groupe_cours_id' => $groupeCours->id,
            'jour' => 'Lundi',
            'heures' => '1111000000',
            'dure' => 2
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors(['local_id']);
    }


    public function test_store_bloc_cours_without_groupe_cours(): void
    {

        $horaire = Horaire::factory()->create();
        $local = Local::factory()->create([
            'horaire_id' => $horaire->id,
        ]);

        $invalidGroupeCoursId = 999;

        $response = $this->postJson('/api/bloccours', [
            'local_id' => $local->id,
            'groupe_cours_id' => $invalidGroupeCoursId,
            'jour' => 'Lundi',
            'heures' => '1111000000',
            'dure' => 2
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors(['groupe_cours_id']);
    }
    public function test_store_bloc_cours_avec_donner_invalide(): void
    {
        $horaire = Horaire::factory()->create();
        $local = Local::factory()->create([
            'horaire_id' => $horaire->id,
        ]);
        $groupeCours = GroupeCours::factory()->create();

        $response = $this->postJson('/api/bloccours', [
            'local_id' => $local->id,
            'groupe_cours_id' => $groupeCours->id,
            'jour' => '',

        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['jour']);
    }

    //section validation
    public function test_validation_bloc_cours_avec_jour_invalide(): void
    {
        $response = $this->postJson('/api/bloccours', [
            'jour' => 'Funday', //invalide
            'heures' => '1111000000',
            'dure' => 2

        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('jour');
    }

    public function test_validation_bloc_cours_avec_format_dheure_invalide(): void
    {
        $response = $this->postJson('/api/bloccours', [
            'jour' => 'Lundi',
            'heures' => 'ABCDEF', // Invalid
            'dure' => 2
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('heures');
    }

    public function test_validation_bloc_cours_avec_invalid_longeur_dheure(): void
    {
        $response = $this->postJson('/api/bloccours', [
            'jour' => 'Lundi',
            'heures' => '1100', // Invalid
            'dure' => 2
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('heures');
    }

    public function test_validation_bloc_cours_avec_invalid_dure(): void
    {
        $response = $this->postJson('/api/bloccours', [
            'jour' => 'Lundi',
            'heures' => '1111000000',
            'dure' => 0 // Invalid
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('dure');
    }

    public function test_validation_bloc_cours_avec_dure_trop_long(): void
    {
        $response = $this->postJson('/api/bloccours', [
            'jour' => 'Lundi',
            'heures' => '1111000000',
            'dure' => 21 // Duration trop long
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('dure');
    }
    // Section show

    public function test_show_retourne_bloc_cours_avec_valid_id(): void
    {

        $horaire = Horaire::factory()->create();
        $local = Local::factory()->create([
            'horaire_id' => $horaire->id,
        ]);

        $groupeCours = GroupeCours::factory()->create([
            'campus_id' => $this->campusId,
            'user_id' => $this->userId,
            'cours_id' => $this->coursId,
        ]);

        $blocCours= BlocCours::factory()->create([
            'local_id' => $local->id,
            'groupe_cours_id' => $groupeCours->id,
        ]);

        $response = $this->getJson("/api/bloccours/{$blocCours->id}");


        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'jour',
                'heures',
            ]
        ]);

        $responseData = $response->json('data');
        $this->assertEquals($blocCours->id, $responseData['id']);

    }

    public function test_show_retourne_non_trouver_invalide_par_id(): void
    {
        $bloccour = BlocCours::factory()->create();
        $bloccour->id = -1;

        $response = $this->getJson("/api/bloccours/{$bloccour->id}");
        $response->assertStatus(404);
    }

    //section update
    public function test_update_bloc_cours_avec_valeur_valide(): void
    {
        // Arrange
        $horaire = Horaire::factory()->create();
        $local = Local::factory()->create([
            'horaire_id' => $horaire->id,
        ]);
        $groupeCours = GroupeCours::factory()->create([
            'campus_id' => $this->campusId,
            'user_id' => $this->userId,
            'cours_id' => $this->coursId,
        ]);
        $blocCours = BlocCours::factory()->create();
        $updatedData = [
            'id'=>$blocCours->id,
            'jour' => 'Mardi',
            'heures' => '0101010101',
            'dure' => 3,
            'local_id' => $local->id,
            'local'=>$local,
            'groupe_cours_id'=>$groupeCours->id
        ];

        // Act
        $response = $this->json('PUT', "/api/bloccours/{$blocCours->id}", $updatedData);

        // Assert
        $response->assertJsonStructure([
            'data' => [
                '*' => [ //Regarde si c un array
                    'id',
                    'jour',
                    'heures',
                    'groupe_cours',
                    'local'
                ]
            ]
        ]);

        //Récupérer le jour
        $jour = Jour::all()->firstWhere('nom', $updatedData['jour']);

        $updatedBlocCours = BlocCours::findOrFail($blocCours->id);
        $this->assertEquals($updatedData['jour'], $jour->nom);
        $this->assertEquals($updatedData['heures'], $updatedBlocCours->heures);
        $this->assertEquals($updatedData['dure'], $updatedBlocCours->dure);
        $this->assertEquals($updatedData['local_id'], $updatedBlocCours->local_id);
    }


    public function test_update_bloc_cours_non_trouvable(): void
    {
        // Arrange
        $horaire = Horaire::factory()->create();
        $local = Local::factory()->create([
            'horaire_id' => $horaire->id,
        ]);

        $bloccour = BlocCours::factory()->create();
        $updatedData = [
            'local_id'=>$local->id,
            'jour'=>'Lundi',
            'heures'=>'0001110000',
            'dure'=>10
        ];

        // Act
        $response = $this->json('PUT', "/api/bloccours/{$bloccour->id}", $updatedData);

        // Assert
        $response->assertStatus(404);
        $response->assertJson([
            'error' => [
                'code' => 404,
                'message' => 'Bloc cours pas trouvé.',
            ]
        ]);
    }
    public function test_destroy_bloc_cours_success()
    {

        $horaire =Horaire::factory()->create();
        Local::factory()->create([
            'horaire_id'=>$horaire->id
        ]);

        $bloccour = BlocCours::factory()->create([
            'jour_id'=>1,
            'heures'=>'0001110000',
             'dure'=>10
        ]);

        $response = $this->deleteJson("/api/bloccours/{$bloccour->id}");

        // Assert
        $this->assertDatabaseMissing('bloc_cours', ['id' => $bloccour->id]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'jour',
                    'heures',
                    'local'
                ]
            ]
        ]);

        $response->assertJsonMissing([
            'data' => [
                'id' => $bloccour->id
            ]
        ]);
    }

    public function test_destroy_bloc_cours_avec_id_invalide()
    {
        $bloccour = BlocCours::factory()->create();
        $bloccour->id = -1;
        $response = $this->deleteJson("/api/bloccours/{$bloccour->id}");

        $response->assertStatus(404);
    }


}
