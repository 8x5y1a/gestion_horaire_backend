<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeContrainteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_contraintes')->insert([
            ['id'=>1,'nom'=>'conciliation', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>2,'nom'=>'reunion', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>3,'nom'=>'generaux', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>4,'nom'=>'universelle', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>5,'nom'=>'preference', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>6,'nom'=>'lies', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>7,'nom'=>'disponibilite', 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>8,'nom'=>'autre', 'created_at'=> now(),'updated_at'=>now()],
        ]);
    }
}
