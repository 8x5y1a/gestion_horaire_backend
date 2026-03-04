<?php

//AUTHOR: Louis-Carl Proulx

namespace Tests\Feature;

use App\Models\Campus;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CampusTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use DatabaseTransactions;
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\CampusSeeder::class);
        $user = User::factory()->create();
        $role = Role::find(1);
        $user->role()->attach($role);
        Sanctum::actingAs($user);
    }

    public function test_index_retourne_toute_campus(): void
    {
        // Act
        $response = $this->getJson('/api/campus');

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'nom',
                ],
            ],
        ]);
    }
    public function testShowReturnsCampusData(): void
    {
        // Arrange
        $campus = Campus::create([
            'nom' => 'Test Campus',
        ]);

        // Act
        $response = $this->getJson("/api/campus/{$campus->id}");

        // Assert
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'id',
                'nom',
            ]
        ]);

        // Assert
        $response->assertJsonFragment([
            'id' => $campus->id,
            'nom' => 'Test Campus',

        ]);
    }
}
