<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlocGenerauxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bloc_generaux')->insert([
            ['id'=>1, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'bloc_libre_id'=>1, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>2, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'bloc_libre_id'=>2, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>3, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'bloc_libre_id'=>2, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>4, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'bloc_libre_id'=>3, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>5, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'bloc_libre_id'=>3, 'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
