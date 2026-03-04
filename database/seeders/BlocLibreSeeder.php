<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlocLibreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bloc_libres')->insert([
            ['id'=>1,'nb_bloc'=>1, 'nb_heure'=>3, 'contrainte_id'=>1, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>2,'nb_bloc'=>2, 'nb_heure'=>2, 'contrainte_id'=>7, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>3,'nb_bloc'=>2, 'nb_heure'=>2, 'contrainte_id'=>8, 'created_at'=> now(),'updated_at'=>now()],
        ]);
    }
}
