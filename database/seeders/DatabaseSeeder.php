<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlocCours;
use App\Models\GroupeCours;
use App\Models\BlocHeure;
use App\Models\BlocLibre;
use App\Models\Cheminement;
use App\Models\Contrainte;
use App\Models\TypeContrainte;
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

        //Appeler les Seeders
        $this->call([
            /* @author Fabrice & Louis */
            JourSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CheminementSeeder::class,
            CoursSeeder::class,
            TypeContrainteSeeder::class,
            ContrainteSeeder::class,
            BlocHeureSeeder::class,
            BlocLibreSeeder::class,
            BlocGenerauxSeeder::class,
            LocalSeeder::class,
            CampusSeeder::class,
        ]);
        $this->call([
            GroupeCourSeeder::class,
            BlocCourSeeder::class,
        ]);
    }
}
