<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlocCourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bloc_cours')->insert([
            ['id'=>1, 'jour'=>'lundi', 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>1, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>2, 'jour'=>'mardi', 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>1, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>3, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>1, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>4, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>2, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>5, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>4, 'groupe_cours_id'=>2, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>6, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>5, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>7, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>6, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>8, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>4, 'groupe_cours_id'=>7, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>9, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>8, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>10, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>9, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>11, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>4, 'groupe_cours_id'=>10, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>12, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>6, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>13, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>5, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>14, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>4, 'groupe_cours_id'=>7, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>15, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>4, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>16, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>4, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>17, 'jour'=>'aucun', 'heures'=>'0000000000', 'dure'=>4, 'groupe_cours_id'=>4, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ]
        );
    }
}
