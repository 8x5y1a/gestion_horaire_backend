<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cours')->insert([
            ['id'=>1,'nom'=>'Logique mathématique', 'code'=>'201-1G0-HU', 'ponderation'=>'2-2-3', 'bloc'=>'2-2', 'local_technique'=>false, 'cours_charge'=>false,'session' => 1, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>2,'nom'=>'Ordinateurs et réseaux de PME', 'code'=>'420-1G1-HU', 'ponderation'=>'2-4-4', 'bloc'=>'3-3', 'local_technique'=>false, 'cours_charge'=>false,'session' => 1, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>3,'nom'=>'Logique de programmation', 'code'=>'420-1G2-HU', 'ponderation'=>'3-4-4', 'bloc'=>'2-2-3', 'local_technique'=>false, 'cours_charge'=>true,'session' => 1, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>4,'nom'=>'Outils et carrière', 'code'=>'420-2G0-HU', 'ponderation'=>'2-2-3', 'bloc'=>'2-2', 'local_technique'=>false, 'cours_charge'=>false,'session' => 2, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>5,'nom'=>'Infrastructure et services réseaux', 'code'=>'420-2G3-HU', 'ponderation'=>'3-4-4', 'bloc'=>'3-2-2', 'local_technique'=>false, 'cours_charge'=>false,'session' => 2, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>6,'nom'=>'Programmation orientée objet', 'code'=>'420-2G4-HU', 'ponderation'=>'3-4-4', 'bloc'=>'3-2-2', 'local_technique'=>false, 'cours_charge'=>true,'session' => 2, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>7,'nom'=>'Exploitation des bases de données', 'code'=>'420-3G2-HU', 'ponderation'=>'2-2-2', 'bloc'=>'2-2', 'local_technique'=>false, 'cours_charge'=>false,'session' => 3, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>8,'nom'=>'Sécurité et choix des technologies', 'code'=>'420-3G7-HU', 'ponderation'=>'2-2-3', 'bloc'=>'2-2', 'local_technique'=>false, 'cours_charge'=>false,'session' => 3, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>9,'nom'=>'Développement d\'application Windows', 'code'=>'420-3P3-HU', 'ponderation'=>'2-2-3', 'bloc'=>'2-2', 'local_technique'=>false, 'cours_charge'=>true,'session' => 3, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>10,'nom'=>'Programmation d\'interfaces WEB', 'code'=>'420-3P4-HU', 'ponderation'=>'2-3-2', 'bloc'=>'2-3', 'local_technique'=>false, 'cours_charge'=>true,'session' => 3, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>11,'nom'=>'Réseaux locaux', 'code'=>'420-3N2-HU', 'ponderation'=>'2-2-3', 'bloc'=>'2-3', 'local_technique'=>false, 'cours_charge'=>false,'session' => 3, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>12,'nom'=>'Serveurs Windows Intranet', 'code'=>'420-3S2-HU', 'ponderation'=>'2-3-2', 'bloc'=>'2-3', 'local_technique'=>false, 'cours_charge'=>false,'session' => 3, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>13,'nom'=>'Communication, lois et éthique', 'code'=>'360-4G0-HU', 'ponderation'=>'3-1-3', 'bloc'=>'2-2', 'local_technique'=>false, 'cours_charge'=>false,'session' => 4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>14,'nom'=>'Soutien informatique', 'code'=>'420-4G3-HU', 'ponderation'=>'1-2-3', 'bloc'=>'3', 'local_technique'=>false, 'cours_charge'=>false,'session' => 4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>15,'nom'=>'Veille technologique', 'code'=>'420-4G7-HU', 'ponderation'=>'1-2', 'bloc'=>'3', 'local_technique'=>false, 'cours_charge'=>false,'session' => 4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>16,'nom'=>'Développement d\'applications mobiles', 'code'=>'420-4P5-HU', 'ponderation'=>'2-2-2', 'bloc'=>'2-2', 'local_technique'=>false, 'cours_charge'=>true,'session' => 4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>17,'nom'=>'Développement WEB en PHP', 'code'=>'420-4P6-HU', 'ponderation'=>'2-2-2', 'bloc'=>'2-2', 'local_technique'=>false, 'cours_charge'=>true,'session' => 4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>18,'nom'=>'Développement WEB en ASP.NET', 'code'=>'420-4P7-HU', 'ponderation'=>'2-3-2', 'bloc'=>'2-3', 'local_technique'=>false, 'cours_charge'=>true,'session' => 4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>19,'nom'=>'Programmation client/serveur', 'code'=>'420-4P8-HU', 'ponderation'=>'2-3-2', 'bloc'=>'2-2', 'local_technique'=>false, 'cours_charge'=>true,'session' => 4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>20,'nom'=>'Routage et commutation', 'code'=>'420-4N1-HU', 'ponderation'=>'2-4-1', 'bloc'=>'3-3', 'local_technique'=>false, 'cours_charge'=>true,'session' => 4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>21,'nom'=>'Serveurs Linux Intranet', 'code'=>'420-4S1-HU', 'ponderation'=>'2-4-1', 'bloc'=>'3-3', 'local_technique'=>false, 'cours_charge'=>true,'session' => 4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>22,'nom'=>'Serveurs Windows Internet', 'code'=>'420-4S2-HU', 'ponderation'=>'2-4-1', 'bloc'=>'3-3', 'local_technique'=>false, 'cours_charge'=>true,'session' => 4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>23,'nom'=>'Projet synthèse', 'code'=>'420-5A1-HU', 'ponderation'=>'3-3-5', 'bloc'=>'3-3', 'local_technique'=>false, 'cours_charge'=>true,'session' => 5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>24,'nom'=>'Conception de logiciels', 'code'=>'420-5A2-HU', 'ponderation'=>'3-5-2', 'bloc'=>'4-4', 'local_technique'=>false, 'cours_charge'=>true,'session' => 5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>25,'nom'=>'Intégration d\'objets connectés', 'code'=>'420-5P0-HU', 'ponderation'=>'2-4-2', 'bloc'=>'3-3', 'local_technique'=>false, 'cours_charge'=>true,'session' => 5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>26,'nom'=>'Sécurité des applications client/serveur', 'code'=>'420-5T1-HU', 'ponderation'=>'2-4-2', 'bloc'=>'3-3', 'local_technique'=>false, 'cours_charge'=>false,'session' => 5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>27,'nom'=>'Sécurité d\'applications WEB en JSP', 'code'=>'420-5T2-HU', 'ponderation'=>'2-4-2', 'bloc'=>'3-3', 'local_technique'=>false, 'cours_charge'=>true,'session' => 5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>28,'nom'=>'Téléphonie IP et sans-fil', 'code'=>'420-5N1-HU', 'ponderation'=>'3-4-2', 'bloc'=>'2-3-2', 'local_technique'=>false, 'cours_charge'=>false,'session' => 5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>29,'nom'=>'Implantation de l\'infrastructure et des services', 'code'=>'420-5N2-HU', 'ponderation'=>'2-3-2', 'bloc'=>'2-3', 'local_technique'=>false, 'cours_charge'=>false,'session' => 5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>30,'nom'=>'Automatisation et scripts', 'code'=>'420-5P1-HU', 'ponderation'=>'2-2-2', 'bloc'=>'2-2', 'local_technique'=>false, 'cours_charge'=>false,'session' => 5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>31,'nom'=>'Réseaux d\'objets connectés', 'code'=>'420-5P2-HU', 'ponderation'=>'1-3-1', 'bloc'=>'2-2', 'local_technique'=>false, 'cours_charge'=>false,'session' => 5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>32,'nom'=>'Serveurs Linux Internet', 'code'=>'420-5S1-HU', 'ponderation'=>'2-2-2', 'bloc'=>'2-2', 'local_technique'=>false, 'cours_charge'=>false,'session' => 5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>33,'nom'=>'Cybersécurité', 'code'=>'420-5T0-HU', 'ponderation'=>'3-4-2', 'bloc'=>'3-2-2', 'local_technique'=>false, 'cours_charge'=>false,'session' => 5, 'created_at'=> now(),'updated_at'=>now()],
        ]);

        DB::table('cheminement_cours')->insert([
            ['cheminement_id'=>1, 'cours_id'=>1], ['cheminement_id'=>2, 'cours_id'=>1],
            ['cheminement_id'=>1, 'cours_id'=>2], ['cheminement_id'=>2, 'cours_id'=>2],
            ['cheminement_id'=>1, 'cours_id'=>3], ['cheminement_id'=>2, 'cours_id'=>3],
            ['cheminement_id'=>1, 'cours_id'=>4], ['cheminement_id'=>2, 'cours_id'=>4],
            ['cheminement_id'=>1, 'cours_id'=>5], ['cheminement_id'=>2, 'cours_id'=>5],
            ['cheminement_id'=>1, 'cours_id'=>6], ['cheminement_id'=>2, 'cours_id'=>6],
            ['cheminement_id'=>1, 'cours_id'=>7], ['cheminement_id'=>2, 'cours_id'=>7],
            ['cheminement_id'=>1, 'cours_id'=>8], ['cheminement_id'=>2, 'cours_id'=>8],
            ['cheminement_id'=>1, 'cours_id'=>9],
            ['cheminement_id'=>1, 'cours_id'=>10],
            ['cheminement_id'=>2, 'cours_id'=>11],
            ['cheminement_id'=>2, 'cours_id'=>12],
            ['cheminement_id'=>1, 'cours_id'=>13], ['cheminement_id'=>2, 'cours_id'=>13],
            ['cheminement_id'=>1, 'cours_id'=>14], ['cheminement_id'=>2, 'cours_id'=>14],
            ['cheminement_id'=>1, 'cours_id'=>15], ['cheminement_id'=>2, 'cours_id'=>15],
            ['cheminement_id'=>1, 'cours_id'=>16],
            ['cheminement_id'=>1, 'cours_id'=>17],
            ['cheminement_id'=>1, 'cours_id'=>18],
            ['cheminement_id'=>1, 'cours_id'=>19],
            ['cheminement_id'=>2, 'cours_id'=>20],
            ['cheminement_id'=>2, 'cours_id'=>21],
            ['cheminement_id'=>2, 'cours_id'=>22],
            ['cheminement_id'=>1, 'cours_id'=>23],
            ['cheminement_id'=>1, 'cours_id'=>24],
            ['cheminement_id'=>1, 'cours_id'=>25],
            ['cheminement_id'=>1, 'cours_id'=>26],
            ['cheminement_id'=>1, 'cours_id'=>27],
            ['cheminement_id'=>2, 'cours_id'=>28],
            ['cheminement_id'=>2, 'cours_id'=>29],
            ['cheminement_id'=>2, 'cours_id'=>30],
            ['cheminement_id'=>2, 'cours_id'=>31],
            ['cheminement_id'=>2, 'cours_id'=>32],
            ['cheminement_id'=>2, 'cours_id'=>33],
        ]);
    }
}
