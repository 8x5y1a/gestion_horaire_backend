<?php



use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

//@Author: Fabrice Fortin
class UserTest extends TestCase
{
    use DatabaseTransactions;
    public function setUp():void{
        parent::setUp();
        $user = User::factory()->create();
        $role = Role::find(1);
        $user->role()->attach($role);
        Sanctum::actingAs($user);
    }
    public function test_creer_User(): void{
        $role = Role::find(1);
        $response = $this->postJson('/api/user',[
            "prenom"=>"test",
            "nom"=>"test",
            "bureau"=>"1.399B",
            "poste"=>"2",
            "email"=>"testing@courriel.ca",
            "role"=>[$role]
        ]);
        $response->assertStatus(200)->assertJson(fn(AssertableJson $json)=> $json->has('data'));
    }
    public function test_creer_User_invalide(): void{
        $response = $this->postJson('/api/user',[
            "prenom"=>"",
            "nom"=>"",
            "bureau"=>str_repeat("d", 34),
            "poste"=>"d",
            "email"=>""
        ]);
        $response->assertStatus(422)->assertJsonValidationErrors(['prenom','nom','bureau','poste','role']);
    }

    public function test_modifier_User(): void
    {
        $role = Role::find(1);
        $user = User::factory()->create();
        $updatedData = [
            "prenom" => "test",
            "nom" => "test",
            "bureau" => "1.399B",
            "poste" => "2",
            "role"=>[$role]
        ];

        $response = $this->json('PUT', "/api/user/{$user->id}", $updatedData);
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
                    'email'
                ],
            ]
        ]);

        $updatedUser = User::findOrFail($user->id);
        $this->assertEquals($updatedData['prenom'], $updatedUser->prenom);
        $this->assertEquals($updatedData['nom'], $updatedUser->nom);
        $this->assertEquals($updatedData['bureau'], $updatedUser->bureau);
        $this->assertEquals($updatedData['poste'], $updatedUser->poste);
    }

    public function test_modifier_User_invalide(): void
    {

        $user = User::factory()->create();
        $updatedData = [
            "prenom" => "",
            "nom" => "",
            "bureau" => str_repeat("d", 34),
            "poste" => "d",
            "email" => ""
        ];

        $response = $this->json('PUT', "/api/user/{$user->id}", $updatedData);

        $response->assertStatus(422)->assertJsonValidationErrors(['prenom','nom','bureau','poste','role']);

    }

    public function test_supprimer_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/user/{$user->id}");

        $this->assertDatabaseMissing('users', ['id' => $user->id]);

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
                    'email'
                ],
            ]
        ]);
        //S'assure que l'objet à été supprimé
        $response->assertJsonMissing([
            'data' => [
                'id' => $user->id
            ]
        ]);
    }
    public function test_supprimer_User_invalide()
    {
        $response = $this->deleteJson('/api/user/' . -8);

        $response->assertStatus(404);

    }
}
