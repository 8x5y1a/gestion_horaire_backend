<?php

//AUTHOR: Louis-Carl Proulx

namespace Tests\Feature;

use App\Models\Campus;
use App\Models\Cours;
use App\Models\GroupeCours;

use App\Models\User;
use App\Models\Role;
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


        $user = User::factory()->create();
        $role = Role::find(1);
        $user->role()->attach($role);
        $this->cours = Cours::factory()->create();
        $this->seed(\Database\Seeders\CampusSeeder::class);
        $this->user = $user->id;
        $this->campus = Campus::first();
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
        $user = User::factory()->create();
        $this->userId = $user->id;
        $cours = Cours::factory()->create();

        $requestData = [
            'nbetud' => $this->faker->numberBetween(10, 100),
            'campus' => $this->campus->id,
            'enseignant' => $user->id,
            'cour' => $cours->id,
            'couleur'=> '#FF0000',
            'groupe'=> 1

        ];

        //act
        $response = $this->postJson('/api/groupecours', $requestData);

        //assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'nbetud',
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
            'user_id' => $requestData['enseignant'],
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

        $user = User::factory()->create();

        $groupecour = GroupeCours::factory()->create([
            'campus_id' => $this->campus->id,
            'user_id' => $user->id,
            'cours_id' => $this->cours->id,
            'couleur'=> '#FF0000'
        ]);

        $response = $this->getJson("/api/groupecours/{$groupecour->id}");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'nbetud',
                'groupe',
                'campus',
                'cour',
                'enseignant',
            ]
        ]);

        $responseData = $response->json('data');
        $this->assertEquals($groupecour->id, $responseData['id']);

    }
    public function test_show_retourne_groupe_cours_avec_invalide_id(): void
    {

        $user = User::factory()->create();

        $groupecour = GroupeCours::factory()->create([
            'campus_id' => $this->campus->id,
            'user_id' => $user->id,
            'cours_id' => $this->cours->id,
        ]);
        $groupecour->id = 99999;
        $response = $this->getJson("/api/groupecours/{$groupecour->id}");

        $response->assertStatus(404);
    }

    //Section delete
    public function test_destroy_groupe_cours_echec_avec_id_invalide()
    {
        $groupeCoursIdInvalide = 999;
        // Act
        $response = $this->deleteJson("/api/groupecours/{$groupeCoursIdInvalide}");

        // Assert
        $response->assertStatus(404);

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
    }
    public function test_destroy_groupe_cours_success()
    {
        // Arrange
        $groupecour = GroupeCours::factory()->create();

        // Act
        $response = $this->deleteJson("/api/groupecours/{$groupecour->id}");

        // Assert
        $this->assertDatabaseMissing('groupe_cours', ['id' => $groupecour->id]);
        $response->assertStatus(200);
    }
    public function test_update_groupe_cours_echec_invalide_user()
    {
        // Arrange
        $groupeCours = GroupeCours::factory()->create();
        $userIdInvalide = 99999;

        // Act
        $response = $this->putJson("/api/groupecours/{$groupeCours->id}", [
            'campus' => $this->campus->id,
            'nbetud' => 20,
            'couleur'=> '#FF0000',
            'user_id' => $userIdInvalide,
            'groupe'=> 1
        ]);

        // Assert
        $response->assertStatus(404);
        $response->assertJson([
            'error' => [
                'code' => 404,
                'message' => 'Enseignant pas trouvé.',
            ]
        ]);
    }
    public function test_update_groupe_cours_success()
    {

        // Arrange
        $groupeCours = GroupeCours::factory()->create();
        $user = User::factory()->create();
        $newNbEtud = 20;



        // Act
        $response = $this->putJson("/api/groupecours/{$groupeCours->id}", [
            'id'=> $groupeCours->id,
            'nbetud' => $newNbEtud,
            'enseignant' => $user->id,
            'couleur'=> '#FF0000',
            'campus' => $this->campus->id,
            'cour' => $this->cours->id,
            'groupe'=> 1
        ]);


        // Assert
        $response->assertJsonFragment([
            'nbetud' => $newNbEtud,
        ]);
        $this->assertDatabaseHas('groupe_cours', [
            'id' => $groupeCours->id,
            'nbetud' => $newNbEtud,
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'nbetud' => $newNbEtud,
        ]);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'nbetud',
                    'groupe',
                    'campus',
                    'cour',
                    'enseignant',
                ],
            ],
        ]);
    }

}
