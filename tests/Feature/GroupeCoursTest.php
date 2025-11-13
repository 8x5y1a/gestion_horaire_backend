<?php

namespace Tests\Feature;

use App\Models\Campus;
use App\Models\Cours;
use App\Models\GroupeCours;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;


class GroupeCoursTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use DatabaseTransactions, WithFaker;
    public function setUp(): void
    {
        parent::setUp();


        $personnel = Personnel::factory()->create();
        $cours = Cours::factory()->create();
        $this->seed(\Database\Seeders\CampusSeeder::class);
        $this->personnel = $personnel->id;
        $this->coursId = $cours->id;
        $this->campus = Campus::first();
        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }

    //section index
    public function test_index_returne_toute_group_cours()
    {

        // Act
        $response = $this->getJson('/api/groupecours');

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [

                ]
            ]
        ]);
    }
    //section store
    public function test_store_groupe_cours_valid()
    {
        // Arrange
        $personnel = Personnel::factory()->create();
        $this->personnelId = $personnel->id;
        $cours = Cours::factory()->create();

        $requestData = [
            'nbetud' => $this->faker->numberBetween(10, 100),
            'campus' => $this->campus->id,
            'enseignant' => $personnel->id,
            'cour' => $cours->id,

        ];

        //act
        $response = $this->postJson('/api/groupecours', $requestData);

        //assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'nbEtud',
                    'groupe',
                    'campus',
                    'cour',
                    'enseignant',
                ],
            ],
        ]);
        $this->assertDatabaseHas('groupe_cours', [
            'nbetud' => $requestData['nbetud'],
            'cours_id' => $requestData['cour'],
            'personnel_id' => $requestData['enseignant'],
            'campus_id' => $requestData['campus'],
        ]);
    }
    //section validation
    public function test_store_echec_sans_NbEtud()
    {
        $response = $this->postJson('/api/groupecours', [

        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('nbetud');
    }


    public function test_store_echec_avec_un_non_interger_NbEtud()
    {
        $response = $this->postJson('/api/groupecours', [
            'nbetud' => 'not-an-integer',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('nbetud');
    }

    public function test_store_echec_NbEtud_trop_petit()
    {
        $response = $this->postJson('/api/groupecours', [
            'nbetud' => 1,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('nbetud');
    }

    public function test_store_echec_avec_NbEtud_trop_grand()
    {
        $response = $this->postJson('/api/groupecours', [
            'nbetud' => 300,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('nbetud');
    }
    //section show
    public function test_show_retourne_groupe_cours_avec_valid_id(): void
    {

        $personnel = Personnel::factory()->create();

        $groupeCours = GroupeCours::factory()->create([
            'campus_id' => $this->campus->id,
            'personnel_id' => $personnel->id,
            'cours_id' => $this->coursId,
        ]);

        $response = $this->getJson("/api/groupecours/{$groupeCours->id}");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'nbEtud',
                'groupe',
                'campus',
                'cour',
                'enseignant',
            ]
        ]);

        $responseData = $response->json('data');
        $this->assertEquals($groupeCours->id, $responseData['id']);

    }
    public function test_show_retourne_groupe_cours_avec_invalide_id(): void
    {

        $personnel = Personnel::factory()->create();

        $groupeCours = GroupeCours::factory()->create([
            'campus_id' => $this->campus->id,
            'personnel_id' => $personnel->id,
            'cours_id' => $this->coursId,
        ]);

        $groupeCoursIdInvalide = 999;
        $response = $this->getJson("/api/groupecours/{$groupeCoursIdInvalide}");

        $response->assertStatus(404);

        $response->assertJson([
            'error' => [
                'code' => 404,
                'message' => 'Groupe cours pas trouvé.',
            ]
        ]);
    }

    //Section delete
    public function test_destroy_groupe_cours_echec_avec_id_invalide()
    {
        // Act
        $response = $this->deleteJson('/api/groupecours/invalid-id');

        // Assert
        $response->assertStatus(404);
        $response->assertJson([
            'error' => [
                'code' => 404,
                'message' => 'Groupe cours introuvable.',
            ]
        ]);
    }
    public function test_destroy_groupe_cours_echec_avec_cours_invalide()
    {
        // Arrange
        $groupeCours = GroupeCours::factory()->create();
        $cours = $groupeCours->cours;
        $cours->delete();

        // Act
        $response = $this->deleteJson('/api/groupecours/' . $groupeCours->id);

        // Assert
        $response->assertStatus(404);
        $response->assertJson([
            'error' => [
                'code' => 404,
                'message' => 'Cours associer non trouver.',
            ]
        ]);
    }
    public function test_destroy_groupe_cours_success()
    {
        // Arrange
        $groupeCours = GroupeCours::factory()->create();

        // Act
        $response = $this->deleteJson('/api/groupecours/' . $groupeCours->id);

        // Assert
        $this->assertDatabaseMissing('groupe_cours', ['id' => $groupeCours->id]);
        $response->assertStatus(200);
    }
    public function test_destroy_groupe_cours_decremente_autre_groupe()
    {
        // Arrange
        $cours = Cours::factory()->create();
        $firstGroupeCours = GroupeCours::factory()->create(['cours_id' => $cours->id, 'groupe' => 1]);
        $secondGroupeCours = GroupeCours::factory()->create(['cours_id' => $cours->id, 'groupe' => 2]);

        // Act
        $this->deleteJson('/api/groupecours/' . $firstGroupeCours->id);

        // Assert
        $updatedSecondGroupeCours = GroupeCours::find($secondGroupeCours->id);
        $this->assertEquals(1, $updatedSecondGroupeCours->groupe);
    }
    public function test_update_groupe_cours_echec_invalide_personnel()
    {
        // Arrange
        $groupeCours = GroupeCours::factory()->create();
        $personnelIdInvalide = 99999;

        // Act
        $response = $this->putJson("/api/groupecours/{$groupeCours->id}", [
            'nbetud' => 20,
            'personnel_id' => $personnelIdInvalide,
        ]);

        // Assert
        $response->assertStatus(404);
        $response->assertJson([
            'error' => [
                'code' => 404,
                'message' => 'enseignant introuvable.',
            ]
        ]);
    }
    public function test_update_groupe_cours_success()
    {
        // Arrange
        $groupeCours = GroupeCours::factory()->create();
        $personnel = Personnel::factory()->create();
        $newNbEtud = 20;

        // Act
        $response = $this->putJson("/api/groupecours/{$groupeCours->id}", [
            'nbetud' => $newNbEtud,
            'personnel_id' => $personnel->id,
        ]);

        // Assert
        $this->assertDatabaseHas('groupe_cours', [
            'id' => $groupeCours->id,
            'nbEtud' => $newNbEtud,
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'nbEtud' => $newNbEtud,
        ]);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'nbEtud',
                    'groupe',
                    'campus',
                    'cour',
                    'enseignant',
                ],
            ],
        ]);
    }

}
