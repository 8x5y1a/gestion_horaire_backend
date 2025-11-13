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
            ['id'=>1,'nom'=>'Cours anglais', 'description'=>'Un cours d\'anglais.', 'type'=>'generaux', 'stricte'=>false, 'session'=>2, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>2,'nom'=>'Liaison Conception & Projet', 'description'=>'Garder le cours de Conception de Logiciel et le cours de Projet Synthèse dans la même journée.', 'type'=>'lies', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>3,'nom'=>'Disponibilité Valérie et Dalicia', 'description'=>'Valérie et Dalicia doivent être disponible pendant une heure à deux reprise dans la semaine.', 'type'=>'disponibilite', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>4,'nom'=>'Pas commencer à 8h - Valérie & Dalicia', 'description'=>'Valérie et Dalicia ne veulent pas commencer à 8h.', 'type'=>'preference', 'stricte'=>false, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>5,'nom'=>'Conciliation travail famille Valérie', 'description'=>'Respect de la demande de conciliation travail famille de Valérie.', 'type'=>'conciliation', 'stricte'=>false, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>6,'nom'=>'Réunion Départementale Valérie', 'description'=>'Une réunion départementale à laquelle Valérie participe.', 'type'=>'reunion', 'stricte'=>true, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>7,'nom'=>'Pause universelle', 'description'=>'La pause universelle.', 'type'=>'universelle', 'stricte'=>false, 'session'=>0, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>8,'nom'=>'Cours complémentaire', 'description'=>'Un cours complémentaire.', 'type'=>'generaux', 'stricte'=>false, 'session'=>3, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>9,'nom'=>'Cours français 104', 'description'=>'Un cours de français.', 'type'=>'generaux', 'stricte'=>false, 'session'=>4, 'created_at'=> now(),'updated_at'=>now()],

        ]);
        DB::table('contrainte_cours')->insert([
            ['contrainte_id'=>2, 'cours_id'=>23],
            ['contrainte_id'=>2, 'cours_id'=>24],
        ]);
        DB::table('contrainte_personnel')->insert([
            ['contrainte_id'=>3, 'personnel_id'=>2],
            ['contrainte_id'=>3, 'personnel_id'=>5],
            ['contrainte_id'=>4, 'personnel_id'=>2],
            ['contrainte_id'=>4, 'personnel_id'=>5],
            ['contrainte_id'=>5, 'personnel_id'=>2],
            ['contrainte_id'=>6, 'personnel_id'=>2]
        ]);
    }
}
