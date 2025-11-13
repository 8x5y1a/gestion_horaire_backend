<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('campus')->insert([
            ['nom'=>'Gabrielle-Roy'],
            ['nom'=>'Felix-Leclerc'],
            ['nom'=>'Louis-Reboul'],
        ]);

    }
}
