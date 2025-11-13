<?php

namespace Database\Seeders;

use App\Models\Horaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * @author Mathieu Lahaie-Richer
 */
class CheminementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cheminements')->insert([
            ['id'=>1,'nom'=>'Technique de l\'informatique', 'option'=>'Programmation et sécurité','horaire_id' => Horaire::factory()->createOne()->id, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>2,'nom'=>'Technique de l\'informatique', 'option'=>'Réseau et cybersécurité','horaire_id' => Horaire::factory()->createOne()->id, 'created_at'=> now(),'updated_at'=>now()],
        ]);
    }
}
