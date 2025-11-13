<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlocHeureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bloc_heures')->insert([
            ['id'=>1,'jour'=>'Lundi', 'heures'=>'1100000000', 'contrainte_id'=>4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>2,'jour'=>'Mardi', 'heures'=>'1100000000', 'contrainte_id'=>4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>3,'jour'=>'Mercredi', 'heures'=>'1100000000', 'contrainte_id'=>4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>4,'jour'=>'Jeudi', 'heures'=>'1100000000', 'contrainte_id'=>4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>5,'jour'=>'Vendredi', 'heures'=>'1100000000', 'contrainte_id'=>4, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>6,'jour'=>'Lundi', 'heures'=>'1100000000', 'contrainte_id'=>5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>7,'jour'=>'Mardi', 'heures'=>'1100000000', 'contrainte_id'=>5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>8,'jour'=>'Mercredi', 'heures'=>'1100000000', 'contrainte_id'=>5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>9,'jour'=>'Jeudi', 'heures'=>'1100000000', 'contrainte_id'=>5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>10,'jour'=>'Vendredi', 'heures'=>'1100000000', 'contrainte_id'=>5, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>11,'jour'=>'Mardi', 'heures'=>'0000000011', 'contrainte_id'=>6, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>12,'jour'=>'Jeudi', 'heures'=>'0000000011', 'contrainte_id'=>6, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>13,'jour'=>'Mercredi', 'heures'=>'0001110000', 'contrainte_id'=>7, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>14,'jour'=>'Lundi', 'heures'=>'0000011100', 'contrainte_id'=>8, 'created_at'=> now(),'updated_at'=>now()],
        ]);
    }
}
