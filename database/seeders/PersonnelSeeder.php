<?php

namespace Database\Seeders;

use App\Models\horaire;
use App\Models\User;
use Database\Factories\HoraireFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* @author Fabrice */
        DB::table('personnels')->insert([
            ['id'=>1,'prenom'=>'Guillaume','nom'=>'St-Georges','bureau'=>'','poste'=>1, 'horaire_id' => Horaire::factory()->createOne()->id,'user_id'=>1 ,'role'=>'Coordonnateur,Enseignant','adresse_courriel'=>'guillaume.stgeorge@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>2,'prenom'=>'Valérie','nom'=>'Levasseur','bureau'=>'','poste'=>2, 'horaire_id' => Horaire::factory()->createOne()->id,'user_id'=>1 ,'role'=>'Enseignant','adresse_courriel'=>'valerie.levasseur@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>3,'prenom'=>'François','nom'=>'Pagé','bureau'=>'','poste'=>344, 'horaire_id' => Horaire::factory()->createOne()->id,'user_id'=>User::factory()->createOne()->id ,'role'=>'Enseignant','adresse_courriel'=>'francois.page@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>4,'prenom'=>'Raphael','nom'=>'Mayrand-St-Gelais','bureau'=>'2.385B','poste'=>13, 'horaire_id' => Horaire::factory()->createOne()->id,'user_id'=>User::factory()->createOne()->id ,'role'=>'Enseignant','adresse_courriel'=>'raphael.mayrandstgelais@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>5,'prenom'=>'Dalicia','nom'=>'Bouallouche','bureau'=>'1.535B','poste'=>34, 'horaire_id' => Horaire::factory()->createOne()->id,'user_id'=>2 ,'role'=>'Enseignant','adresse_courriel'=>'dalicia.bouallouche@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>6,'prenom'=>'Maryse','nom'=>'Mongeau','bureau'=>'1.235B','poste'=>44, 'horaire_id' => Horaire::factory()->createOne()->id,'user_id'=>3 ,'role'=>'Enseignant','adresse_courriel'=>'maryse.mongeau@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>7,'prenom'=>'Sébastien','nom'=>'Huneault','bureau'=>'1.085B','poste'=>14, 'horaire_id' => Horaire::factory()->createOne()->id,'user_id'=>3 ,'role'=>'Enseignant','adresse_courriel'=>'sebastien.huneault@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>8,'prenom'=>'Ahmed','nom'=>'Bounouar','bureau'=>'1.085A','poste'=>14, 'horaire_id' => Horaire::factory()->createOne()->id,'user_id'=>3 ,'role'=>'Enseignant','adresse_courriel'=>'ahmed.bounouar@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now()],
        ]);
    }
}
