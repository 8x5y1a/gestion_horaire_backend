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
            //Valérie
            ['id'=>1, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>1, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>2, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>2, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>3, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>2, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],

            //Hasna
            ['id'=>4, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>3, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>5, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>3, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>6, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>4, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>7, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>4, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>8, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>5, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],

            //Pierre
            ['id'=>9, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>6, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>10, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>6, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>11, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>7, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>12, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>7, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>13, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>8, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>14, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>8, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>15, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>8, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            //Raphael
            ['id'=>16, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>9, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>17, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>9, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>18, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>10, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>19, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>10, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>20, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>11, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>21, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>11, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>22, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>12, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>23, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>12, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            //Guillaume
            ['id'=>24, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>13, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>25, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>13, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>26, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>14, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>27, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>14, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],

            //Dalicia
            ['id'=>28, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>4, 'groupe_cours_id'=>15, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>29, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>4, 'groupe_cours_id'=>15, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>30, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>16, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>31, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>16, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>32, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>16, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            //Faouzi
            ['id'=>33, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>17, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>34, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>17, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>35, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>18, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>36, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>18, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>37, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>19, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>38, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>19, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            //Ahmed
            ['id'=>39, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>20, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>40, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>20, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>41, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>21, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>42, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>21, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>43, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>22, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>44, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>22, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            //Rémy
            ['id'=>45, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>23, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>46, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>23, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>47, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>24, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>48, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>24, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>49, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>24, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>50, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>25, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>51, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>25, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>52, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>25, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            //Abdelouadoud
            ['id'=>53, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>26, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>54, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>26, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>55, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>27, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>56, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>27, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>57, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>28, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>58, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>28, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            //Maryse
            ['id'=>59, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>29, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>60, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>29, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>61, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>30, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>62, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>30, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>63, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>31, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>64, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>31, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            //Sébastien
            ['id'=>65, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>32, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>66, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>32, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>67, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>3, 'groupe_cours_id'=>33, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>68, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>33, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>69, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>33, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            //Enseignant Temporaire
            ['id'=>70, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>34, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>71, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>34, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>72, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>35, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>73, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>35, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>74, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>36, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>75, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>36, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>76, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>37, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],
            ['id'=>77, 'jour_id'=>9, 'heures'=>'0000000000', 'dure'=>2, 'groupe_cours_id'=>37, 'local_id'=>null, 'created_at'=>now(),'updated_at'=>now()],

        ]
        );
    }
}
