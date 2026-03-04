<?php

namespace Database\Seeders;

use App\Models\Horaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locaux')->insert([
            ['id'=>1,'no_local' => '1.085', 'capacite'=>25, 'local_technique'=>false, 'horaire_id'=>Horaire::factory()->createOne()->id, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>2,'no_local' => '1.105A', 'capacite'=>26, 'local_technique'=>false, 'horaire_id'=>Horaire::factory()->createOne()->id, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>3,'no_local' => '1.073', 'capacite'=>25, 'local_technique'=>true, 'horaire_id'=>Horaire::factory()->createOne()->id, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>4,'no_local' => '1.063', 'capacite'=>25, 'local_technique'=>false, 'horaire_id'=>Horaire::factory()->createOne()->id, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>5,'no_local' => '2.708', 'capacite'=>25, 'local_technique'=>false, 'horaire_id'=>Horaire::factory()->createOne()->id, 'created_at'=> now(),'updated_at'=>now()],
            ]);
    }
}
