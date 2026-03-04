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
            //Valérie
            ['id'=>1, 'nbetud'=>25, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>34, 'user_id'=>2,'couleur' =>'#A5340D'],
            ['id'=>2, 'nbetud'=>24, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>23, 'user_id'=>2,'couleur' =>'#FF5733' ],

            //Hasna
            ['id'=>3, 'nbetud'=>23, 'groupe'=>4,'campus_id'=>1, 'cours_id'=>3, 'user_id'=>10,'couleur' =>'#3357FF' ],
            ['id'=>4, 'nbetud'=>24, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>9, 'user_id'=>10,'couleur' =>'#F833FF' ],
            ['id'=>5, 'nbetud'=>26, 'groupe'=>201,'campus_id'=>1, 'cours_id'=>35, 'user_id'=>10,'couleur' =>'#03ABF8' ],

            //Pierre
            ['id'=>6, 'nbetud'=>22, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>29, 'user_id'=>9,'couleur' =>'#F2C511' ],
            ['id'=>7, 'nbetud'=>22, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>30, 'user_id'=>9,'couleur' =>'#FD8C33' ],
            ['id'=>8, 'nbetud'=>20, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>22, 'user_id'=>9,'couleur' =>'#8C33FF' ],

            //Raphael
            ['id'=>9, 'nbetud'=>21, 'groupe'=>3,'campus_id'=>1, 'cours_id'=>36, 'user_id'=>4,'couleur' =>'#33AA8C' ],
            ['id'=>10, 'nbetud'=>23, 'groupe'=>2,'campus_id'=>1, 'cours_id'=>36, 'user_id'=>4,'couleur' =>'#FF0000' ],
            ['id'=>11, 'nbetud'=>23, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>36, 'user_id'=>4,'couleur' =>'#FF7F00' ],
            ['id'=>12, 'nbetud'=>22, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>30, 'user_id'=>4,'couleur' =>'#FFBF00' ],

            //Guillaume
            ['id'=>13, 'nbetud'=>22, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>11, 'user_id'=>1,'couleur' =>'#0BAA00' ],
            ['id'=>14, 'nbetud'=>23, 'groupe'=>2,'campus_id'=>1, 'cours_id'=>8, 'user_id'=>1,'couleur' =>'#00EA00' ],

            //Dalicia
            ['id'=>15, 'nbetud'=>23, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>24, 'user_id'=>5,'couleur' =>'#30D2BC' ],
            ['id'=>16, 'nbetud'=>20, 'groupe'=>3,'campus_id'=>1, 'cours_id'=>3, 'user_id'=>5,'couleur' =>'#00BAAF' ],

            //Faouzi
            ['id'=>17, 'nbetud'=>20, 'groupe'=>4,'campus_id'=>1, 'cours_id'=>2, 'user_id'=>12,'couleur' =>'#007FFF' ],
            ['id'=>18, 'nbetud'=>20, 'groupe'=>3,'campus_id'=>1, 'cours_id'=>2, 'user_id'=>12,'couleur' =>'#0000FF' ],
            ['id'=>19, 'nbetud'=>20, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>8, 'user_id'=>12,'couleur' =>'#7F00FF' ],

            //Ahmed
            ['id'=>20, 'nbetud'=>22, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>27, 'user_id'=>8,'couleur' =>'#FF00FF' ],
            ['id'=>21, 'nbetud'=>20, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>7, 'user_id'=>8,'couleur' =>'#FF007F' ],
            ['id'=>22, 'nbetud'=>20, 'groupe'=>2,'campus_id'=>1, 'cours_id'=>7, 'user_id'=>8,'couleur' =>'#7F0000' ],

            //Rémy
            ['id'=>23, 'nbetud'=>22, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>31, 'user_id'=>13,'couleur' =>'#7F3F00' ],
            ['id'=>24, 'nbetud'=>22, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>3, 'user_id'=>13,'couleur' =>'#7F7F00' ],
            ['id'=>25, 'nbetud'=>22, 'groupe'=>2,'campus_id'=>1, 'cours_id'=>3, 'user_id'=>13,'couleur' =>'#3F7F00' ],

            //Abdelouadoud
            ['id'=>26, 'nbetud'=>22, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>2, 'user_id'=>11,'couleur' =>'#007F00' ],
            ['id'=>27, 'nbetud'=>23, 'groupe'=>2,'campus_id'=>1, 'cours_id'=>2, 'user_id'=>11,'couleur' =>'#007F7F' ],
            ['id'=>28, 'nbetud'=>22, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>21, 'user_id'=>11,'couleur' =>'#003F7F' ],

            //Maryse
            ['id'=>29, 'nbetud'=>22, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>10, 'user_id'=>6,'couleur' =>'#00007F' ],
            ['id'=>30, 'nbetud'=>23, 'groupe'=>2,'campus_id'=>1, 'cours_id'=>10, 'user_id'=>6,'couleur' =>'#3F007F' ],
            ['id'=>31, 'nbetud'=>23, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>25, 'user_id'=>6,'couleur' =>'#7F007F' ],

            //Sébastien
            ['id'=>32, 'nbetud'=>23, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>26, 'user_id'=>7,'couleur' =>'#7F003F' ],
            ['id'=>33, 'nbetud'=>22, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>33, 'user_id'=>7,'couleur' =>'#808080' ],

            //Enseignant temporaire
            ['id'=>34, 'nbetud'=>24, 'groupe'=>1,'campus_id'=>1, 'cours_id'=>13, 'user_id'=>14,'couleur' =>'#D2691E' ],
            ['id'=>35, 'nbetud'=>22, 'groupe'=>2,'campus_id'=>1, 'cours_id'=>13, 'user_id'=>14,'couleur' =>'#DC143C' ],
            ['id'=>36, 'nbetud'=>23, 'groupe'=>3,'campus_id'=>1, 'cours_id'=>13, 'user_id'=>14,'couleur' =>'#FF4500' ],
            ['id'=>37, 'nbetud'=>21, 'groupe'=>4,'campus_id'=>1, 'cours_id'=>13, 'user_id'=>14,'couleur' =>'#2E8B57' ],

        ]);
    }
}
