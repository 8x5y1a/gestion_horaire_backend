<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* @author Fabrice */
        DB::table('jours')->insert([
            ['id'=>1,'nom'=>'Lundi'],
            ['id'=>2,'nom'=>'Mardi'],
            ['id'=>3,'nom'=>'Mercredi'],
            ['id'=>4,'nom'=>'Jeudi'],
            ['id'=>5,'nom'=>'Vendredi'],
            ['id'=>6,'nom'=>'Samedi'],
            ['id'=>7,'nom'=>'Dimanche'],
            ['id'=>8,'nom'=>'Quotidien'],
            ['id'=>9,'nom'=>'Aucun'],
        ]);
    }
}
