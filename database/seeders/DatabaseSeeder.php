<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlocCours;
use App\Models\GroupeCours;
use App\Models\BlocHeure;
use App\Models\BlocLibre;
use App\Models\Cheminement;
use App\Models\Contrainte;
use App\Models\Personnel;
use App\Models\User;
use App\Models\Local;
use App\Models\Cours;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Créer un utilisateur test pour chaque rôle
        \App\Models\User::factory()->create([
            'name'=>'Enseignant',
            'email'=>'enseignant@test.com',
            'password' => bcrypt("Enseignant1")
        ]);
        \App\Models\User::factory()->create([
            'name'=>'Administrateur',
            'email'=>'admin@gmail.com',
            'password' => bcrypt("password")
        ]);
        \App\Models\User::factory()->create([
            'name'=>'Coordonnateur',
            'email'=>'coordonnateur@test.com',
            'password' => bcrypt("Coordonnateur1")
        ]);
        //Appeler les Seeders
        $this->call([
            /* @author Fabrice & Louis */
            PersonnelSeeder::class,
            CheminementSeeder::class,
            CoursSeeder::class,
            ContrainteSeeder::class,
            BlocHeureSeeder::class,
            BlocLibreSeeder::class,
            LocalSeeder::class,
            CampusSeeder::class,
        ]);
        //Créer des données avec les Factories
        User::factory(5)->create();
        $this->call([
            GroupeCourSeeder::class,
            BlocCourSeeder::class,
        ]);
    }
}
