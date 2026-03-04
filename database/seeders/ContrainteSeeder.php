<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContrainteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contraintes')->insert([
            //Contraintes de tests
            ['id'=>1,'nom'=>'604-1A2-HU Cours anglais', 'description'=>'Un cours d\'anglais.', 'type_contrainte_id'=>3, 'type_description'=>'', 'stricte'=>false, 'session'=>2, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>2,'nom'=>'Liaison Conception & Projet', 'description'=>'Garder le cours de Conception de Logiciel et le cours de Projet Synthèse dans la même journée.', 'type_contrainte_id'=>6, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>3,'nom'=>'Disponibilité Valérie et Dalicia', 'description'=>'Valérie et Dalicia doivent être disponible pendant une heure à deux reprise dans la semaine.', 'type_contrainte_id'=>7, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>4,'nom'=>'Pas commencer à 8h - Valérie & Dalicia', 'description'=>'Valérie et Dalicia ne veulent pas commencer à 8h.', 'type_contrainte_id'=>5, 'type_description'=>'', 'stricte'=>false, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],

            //Réunions
            ['id'=>5,'nom'=>'Réunion Départementale Valérie', 'description'=>'Une réunion départementale à laquelle Valérie participe.', 'type_contrainte_id'=>2, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>16,'nom'=>'Réunion Inconnue Rémy', 'description'=>'Une réunion à laquelle Rémy participe.', 'type_contrainte_id'=>2, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>17,'nom'=>'RCP et RCD', 'description'=>'Une réunion à laquelle Valérie participe.', 'type_contrainte_id'=>2, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>18,'nom'=>'Réunion Inconnue Valérie', 'description'=>'Une réunion à laquelle Valérie participe.', 'type_contrainte_id'=>2, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>19,'nom'=>'CRT', 'description'=>'Une réunion CRT à laquelle Valérie participe.', 'type_contrainte_id'=>2, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>20,'nom'=>'CP- TAG', 'description'=>'Réunion de comité de programme TAG de Hasna.', 'type_contrainte_id'=>2, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>21,'nom'=>'CP- Sc,Lettres et arts', 'description'=>'Réunion de comité de programme sciences, Lettres et arts de Pierre.', 'type_contrainte_id'=>2, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>23,'nom'=>'RCP et RCD', 'description'=>'Une réunion à laquelle Guillaume participe.', 'type_contrainte_id'=>2, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>24,'nom'=>'Commission des Études', 'description'=>'Une réunion à laquelle Guillaume participe.', 'type_contrainte_id'=>2, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>25,'nom'=>'Réunion Inconnue Dalicia', 'description'=>'Une réunion à laquelle Dalicia participe.', 'type_contrainte_id'=>2, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],

            //Autre campus
            ['id'=>22,'nom'=>'Enseigne à Louis Reboul', 'description'=>'Raphael enseigne à Louis Reboul.', 'type_contrainte_id'=>8, 'type_description'=>'Cours hors technique', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],

            //Insertion Professionelle
            ['id'=>15,'nom'=>'Insertion professionelle', 'description'=>'Raphael prend du temps pour un autre travail.', 'type_contrainte_id'=>8, 'type_description'=>'Autre travail', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],

            //Universelles
            ['id'=>6,'nom'=>'Pause universelle', 'description'=>'La pause universelle.', 'type_contrainte_id'=>4, 'type_description'=>'', 'stricte'=>false, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],

            //Cours généraux
            ['id'=>7,'nom'=>'340-C02-HU Cours complémentaire', 'description'=>'Un cours complémentaire.', 'type_contrainte_id'=>3, 'type_description'=>'', 'stricte'=>false, 'session'=>3, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>8,'nom'=>'601-104-MQ Cours français 104', 'description'=>'Un cours de français.', 'type_contrainte_id'=>3, 'type_description'=>'', 'stricte'=>false, 'session'=>4, 'created_at'=> now(),'updated_at'=>now()],

            //Conciliation travail-famille
            ['id'=>9,'nom'=>'Conciliation travail famille Valérie', 'description'=>'Respect de la demande de conciliation travail famille de Valérie.', 'type_contrainte_id'=>1, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>10,'nom'=>'Conciliation travail famille Dalicia', 'description'=>'Respect de la demande de conciliation travail famille de Dalicia.', 'type_contrainte_id'=>1, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>11,'nom'=>'Conciliation travail famille Rémy', 'description'=>'Respect de la demande de conciliation travail famille de Rémy.', 'type_contrainte_id'=>1, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>12,'nom'=>'Conciliation travail famille Sébastien', 'description'=>'Respect de la demande de conciliation travail famille de Sébastien.', 'type_contrainte_id'=>1, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>13,'nom'=>'Conciliation travail famille Maryse', 'description'=>'Respect de la demande de conciliation travail famille de Maryse.', 'type_contrainte_id'=>1, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>14,'nom'=>'Conciliation travail famille Guillaume', 'description'=>'Respect de la demande de conciliation travail famille de Guillaume.', 'type_contrainte_id'=>1, 'type_description'=>'', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],

        ]);
        DB::table('contrainte_cours')->insert([
            ['contrainte_id'=>2, 'cours_id'=>23],
            ['contrainte_id'=>2, 'cours_id'=>24],
        ]);
        DB::table('contrainte_user')->insert([
            ['contrainte_id'=>3, 'user_id'=>2],
            ['contrainte_id'=>3, 'user_id'=>5],
            ['contrainte_id'=>4, 'user_id'=>2],
            ['contrainte_id'=>4, 'user_id'=>5],
            ['contrainte_id'=>5, 'user_id'=>2],
            ['contrainte_id'=>16, 'user_id'=>13],
            ['contrainte_id'=>17, 'user_id'=>2],
            ['contrainte_id'=>18, 'user_id'=>2],
            ['contrainte_id'=>19, 'user_id'=>2],
            ['contrainte_id'=>20, 'user_id'=>10],
            ['contrainte_id'=>21, 'user_id'=>9],
            ['contrainte_id'=>23, 'user_id'=>1],
            ['contrainte_id'=>24, 'user_id'=>1],
            ['contrainte_id'=>25, 'user_id'=>5],
            ['contrainte_id'=>22, 'user_id'=>4],
            ['contrainte_id'=>15, 'user_id'=>4],
            ['contrainte_id'=>9, 'user_id'=>2],
            ['contrainte_id'=>10, 'user_id'=>5],
            ['contrainte_id'=>11, 'user_id'=>13],
            ['contrainte_id'=>12, 'user_id'=>7],
            ['contrainte_id'=>13, 'user_id'=>6],
            ['contrainte_id'=>14, 'user_id'=>1],


        ]);
    }
}
