<?php

namespace Database\Factories;

use App\Models\Horaire;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personnel>
 */
class PersonnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            'prenom' => fake()->name(),
            'nom' => $user->name,
            'bureau' => fake()->randomElement(['1.860','1.840','1.810','1.360','1.160','1.640','2.630']), // fake()->regexify("[1-2]\.[0-9]{3}[A-B]?") ?
            'poste' => fake()->numberBetween(100,300),
            'role' => fake()->randomElement(['Enseignant','Coordonnateur','Administrateur',
                'Coordonnateur,Administrateur','Coordonnateur,Administrateur,Enseignant'
                ,'Administrateur,Enseignant','Coordonnateur,Enseignant']),
            'adresse_courriel' => $user->email,
            'user_id' => $user->id,
            'horaire_id' => Horaire::factory()->create()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
