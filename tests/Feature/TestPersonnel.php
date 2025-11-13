<?php



use App\Models\Personnel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

//@Author: Fabrice Fortin
class TestPersonnel extends TestCase
{
    use DatabaseTransactions;
    public function setUp():void{
        parent::setUp();
        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }
    public function test_creer_Personnel(): void{
        $response = $this->postJson('/api/personnel',[
            "prenom"=>"test",
            "nom"=>"test",
            "bureau"=>"1.399B",
            "poste"=>"2",
            "role"=>"Enseignant",
            "adresse_courriel"=>"testing@courriel.ca"
        ]);
        $response->assertStatus(200)->assertJson(fn(AssertableJson $json)=> $json->has('data'));
    }
    public function test_creer_Personnel_invalide(): void{
        $response = $this->postJson('/api/personnel',[
            "prenom"=>"",
            "nom"=>"",
            "bureau"=>"d",
            "poste"=>"d",
            "role"=>"",
            "adresse_courriel"=>""
        ]);
        $response->assertStatus(422)->assertJsonValidationErrors(['prenom','nom','bureau','poste']);
    }

    public function test_modifier_Personnel(): void
    {
        $personnel = Personnel::factory()->create();
        $updatedData = [
            "prenom" => "test",
            "nom" => "test",
            "bureau" => "1.399B",
            "poste" => "2",
            "role" => "Enseignant",
        ];

        $response = $this->json('PUT', "/api/personnel/{$personnel->id}", $updatedData);
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'prenom',
                    'nom',
                    'bureau',
                    'poste',
                    'role',
                    'adresse_courriel'

                ]
            ]
        ]);

        $updatedPersonnel = Personnel::findOrFail($personnel->id);
        $this->assertEquals($updatedData['prenom'], $updatedPersonnel->prenom);
        $this->assertEquals($updatedData['nom'], $updatedPersonnel->nom);
        $this->assertEquals($updatedData['bureau'], $updatedPersonnel->bureau);
        $this->assertEquals($updatedData['poste'], $updatedPersonnel->poste);
        $this->assertEquals($updatedData['role'], $updatedPersonnel->role);
    }

    public function test_modifier_Personnel_invalide(): void
    {

        $personnel = Personnel::factory()->create();
        $updatedData = [
            "prenom" => "",
            "nom" => "",
            "bureau" => "d",
            "poste" => "d",
            "role" => "",
            "adresse_courriel" => ""
        ];

        $response = $this->json('PUT', "/api/personnel/{$personnel->id}", $updatedData);

        $response->assertStatus(422)->assertJsonValidationErrors(['prenom','nom','bureau','poste']);

    }

    public function test_supprimer_personnel()
    {
        $personnel = Personnel::factory()->create();

        $response = $this->deleteJson('/api/personnel/' . $personnel->id);

        $this->assertDatabaseMissing('personnels', ['id' => $personnel->id]);

        $response->assertStatus(200);
        //Tester que les propriétés existe dans la database
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'prenom',
                    'nom',
                    'bureau',
                    'poste',
                    'role',
                    'adresse_courriel'
                ]
            ]
        ]);
        //S'assure que l'objet à été supprimé
        $response->assertJsonMissing([
            'data' => [
                'id' => $personnel->id
            ]
        ]);
    }
    public function test_supprimer_personnel_invalide()
    {
        $response = $this->deleteJson('/api/personnel/' . -8);

        $response->assertStatus(404);

    }
}
