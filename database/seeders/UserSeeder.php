<?php

namespace Database\Seeders;

use App\Models\horaire;
use App\Models\User;
use Database\Factories\HoraireFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* @author Fabrice */
        DB::table('users')->insert([
            ['id'=>1,'prenom'=>'Guillaume','nom'=>'St-Georges','password'=>bcrypt('password1'),'bureau'=>'1.051','poste'=>'2257', 'horaire_id' => Horaire::factory()->createOne()->id ,'email'=>'Guillaume.St-Georges@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],
            ['id'=>2,'prenom'=>'Valérie','nom'=>'Levasseur','password'=>bcrypt('password1'),'bureau'=>'1.075','poste'=>'2017', 'horaire_id' => Horaire::factory()->createOne()->id ,'email'=>'Valerie.Levasseur@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],
            ['id'=>3,'prenom'=>'François','nom'=>'Pagé','password'=>bcrypt('password1'),'bureau'=>null,'poste'=>null, 'horaire_id' => Horaire::factory()->createOne()->id,'email'=>'Francois.Page@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],
            ['id'=>4,'prenom'=>'Raphaël','nom'=>'Mayrand-St-Gelais','password'=>bcrypt('password1'),'bureau'=>null,'poste'=>null, 'horaire_id' => Horaire::factory()->createOne()->id,'email'=>'Raphael.Mayrand-St-Gelais@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],
            ['id'=>5,'prenom'=>'Dalicia','nom'=>'Bouallouche','password'=>bcrypt('password1'),'bureau'=>'1.075','poste'=>null, 'horaire_id' => Horaire::factory()->createOne()->id,'email'=>'Dalicia.Bouallouche@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],
            ['id'=>6,'prenom'=>'Maryse','nom'=>'Mongeau','password'=>bcrypt('password1'),'bureau'=>'1.075A','poste'=>'2023', 'horaire_id' => Horaire::factory()->createOne()->id ,'email'=>'Maryse.Mongeau@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],
            ['id'=>7,'prenom'=>'Sébastien','nom'=>'Huneault','password'=>bcrypt('password1'),'bureau'=>'1.077','poste'=>'2024', 'horaire_id' => Horaire::factory()->createOne()->id,'email'=>'Sebastien.Huneault@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],
            ['id'=>8,'prenom'=>'Ahmed','nom'=>'Bounouar','password'=>bcrypt('password1'),'bureau'=>'1.067','poste'=>'2291', 'horaire_id' => Horaire::factory()->createOne()->id,'email'=>'Ahmed.Bounouar@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],
            ['id'=>9,'prenom'=>'Pierre','nom'=>'Gauthier','password'=>bcrypt('password1'),'bureau'=>'1.071','poste'=>'2531', 'horaire_id' => Horaire::factory()->createOne()->id ,'email'=>'Pierre.Gauthier@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],
            ['id'=>10,'prenom'=>'Hasna','nom'=>'Hocini','password'=>bcrypt('password1'),'bureau'=>'1.075A','poste'=>'2286', 'horaire_id' => Horaire::factory()->createOne()->id,'email'=>'Hasna.Hocini@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],
            ['id'=>11,'prenom'=>'Abdelouadoud','nom'=>'Stambouli','password'=>bcrypt('password1'),'bureau'=>null,'poste'=>null, 'horaire_id' => Horaire::factory()->createOne()->id,'email'=>'Abdelouadoud.Stambouli@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],
            ['id'=>12,'prenom'=>'Faouzi','nom'=>'Bouguerra','password'=>bcrypt('password1'),'bureau'=>'1.065','poste'=>'2276', 'horaire_id' => Horaire::factory()->createOne()->id,'email'=>'Faouzi.Bouguerra@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],
            ['id'=>13,'prenom'=>'Rémy','nom'=>'Corriveau','password'=>bcrypt('password1'),'bureau'=>'1.077','poste'=>'2290', 'horaire_id' => Horaire::factory()->createOne()->id ,'email'=>'Remy.Corriveau@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],
            ['id'=>14,'prenom'=>'Enseignant','nom'=>'Temporaire','password'=>bcrypt('password1'),'bureau'=>null,'poste'=>null, 'horaire_id' => Horaire::factory()->createOne()->id,'email'=>'enseignant.temporaire@cegepoutaouais.qc.ca', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => false],

            //Compte de tests
            ['id'=>17,'prenom'=>'Un','nom'=>'Administrateur','password'=>bcrypt('password1'),'bureau'=>null,'poste'=>null, 'horaire_id' => Horaire::factory()->createOne()->id,'email'=>'admin@gmail.com', 'created_at'=> now(),'updated_at'=>now(),'email_verified_at' => now(), 'premiere_utilisation' => true],
        ]);
        DB::table('role_user')->insert([
            ['user_id'=>17,'role_id'=>1],
            ['user_id'=>1,'role_id'=>1],
            ['user_id'=>1,'role_id'=>2],
            ['user_id'=>2,'role_id'=>3],
            ['user_id'=>3,'role_id'=>3],
            ['user_id'=>4,'role_id'=>3],
            ['user_id'=>5,'role_id'=>3],
            ['user_id'=>6,'role_id'=>3],
            ['user_id'=>7,'role_id'=>3],
            ['user_id'=>8,'role_id'=>3],
            ['user_id'=>9,'role_id'=>3],
            ['user_id'=>10,'role_id'=>3],
            ['user_id'=>11,'role_id'=>3],
            ['user_id'=>12,'role_id'=>3],
            ['user_id'=>13,'role_id'=>3],
            ['user_id'=>14,'role_id'=>3],
        ]);
    }

}
