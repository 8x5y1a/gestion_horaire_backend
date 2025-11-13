<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupeCourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('groupe_cours')->insert([
            ['id'=>1, 'nbEtud'=>20, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>1, 'personnel_id'=>1],
            ['id'=>2, 'nbEtud'=>20, 'groupe'=>1, 'campus_id'=>2, 'cours_id'=>2, 'personnel_id'=>2],
            ['id'=>3, 'nbEtud'=>20, 'groupe'=>2, 'campus_id'=>1, 'cours_id'=>1, 'personnel_id'=>1],
            ['id'=>4, 'nbEtud'=>20, 'groupe'=>1, 'campus_id'=>2, 'cours_id'=>3, 'personnel_id'=>3],
            ['id'=>5, 'nbEtud'=>20, 'groupe'=>2, 'campus_id'=>1, 'cours_id'=>3, 'personnel_id'=>3],
            ['id'=>6, 'nbEtud'=>20, 'groupe'=>2, 'campus_id'=>1, 'cours_id'=>4, 'personnel_id'=>1],
            ['id'=>7, 'nbEtud'=>20, 'groupe'=>2, 'campus_id'=>1, 'cours_id'=>4, 'personnel_id'=>1],
            ['id'=>8, 'nbEtud'=>20, 'groupe'=>2, 'campus_id'=>1, 'cours_id'=>4, 'personnel_id'=>4],
            ['id'=>9, 'nbEtud'=>20, 'groupe'=>2, 'campus_id'=>1, 'cours_id'=>5, 'personnel_id'=>4],
            ['id'=>10, 'nbEtud'=>20, 'groupe'=>2, 'campus_id'=>1, 'cours_id'=>5, 'personnel_id'=>4],
        ]);
    }
}
