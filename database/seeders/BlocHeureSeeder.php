<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlocHeureSeeder extends Seeder
{
    /**@author Fabrice Fortin
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bloc_heures')->insert([
            //Valérie
            ['id'=>1,'jour_id'=>3, 'heures'=>'0001110000', 'contrainte_id'=>6, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>2,'jour_id'=>2, 'heures'=>'0110000000', 'contrainte_id'=>17, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>3,'jour_id'=>2, 'heures'=>'0000000011', 'contrainte_id'=>18, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>4,'jour_id'=>3, 'heures'=>'0000011110', 'contrainte_id'=>19, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>5,'jour_id'=>4, 'heures'=>'0000000011', 'contrainte_id'=>16, 'created_at'=> now(),'updated_at'=>now()],

            //Hasna
            ['id'=>36,'jour_id'=>2, 'heures'=>'0000000011', 'contrainte_id'=>20, 'created_at'=> now(),'updated_at'=>now()],

            //Pierre
            ['id'=>37,'jour_id'=>4, 'heures'=>'0000001100', 'contrainte_id'=>21, 'created_at'=> now(),'updated_at'=>now()],

            //Guillaume
            ['id'=>38,'jour_id'=>2, 'heures'=>'0110000000', 'contrainte_id'=>23, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>39,'jour_id'=>4, 'heures'=>'0000011110', 'contrainte_id'=>24, 'created_at'=> now(),'updated_at'=>now()],

            //Dalicia
            ['id'=>40,'jour_id'=>4, 'heures'=>'0000000011', 'contrainte_id'=>25, 'created_at'=> now(),'updated_at'=>now()],

            //Rahpael
            ['id'=>41,'jour_id'=>3, 'heures'=>'0000001111', 'contrainte_id'=>22, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>42,'jour_id'=>4, 'heures'=>'0000011000', 'contrainte_id'=>22, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>43,'jour_id'=>5, 'heures'=>'0000010000', 'contrainte_id'=>22, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>44,'jour_id'=>5, 'heures'=>'1111100000', 'contrainte_id'=>15, 'created_at'=> now(),'updated_at'=>now()],

            //Conciliation Travail-Famille
            ['id'=>6,'jour_id'=>8, 'heures'=>'0000000001', 'contrainte_id'=>9, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>11,'jour_id'=>8, 'heures'=>'0000000001', 'contrainte_id'=>10, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>16,'jour_id'=>8, 'heures'=>'0000000001', 'contrainte_id'=>11, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>21,'jour_id'=>8, 'heures'=>'0000000001', 'contrainte_id'=>12, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>26,'jour_id'=>8, 'heures'=>'0000000001', 'contrainte_id'=>13, 'created_at'=> now(),'updated_at'=>now()],
            ['id'=>31,'jour_id'=>8, 'heures'=>'0000000001', 'contrainte_id'=>14, 'created_at'=> now(),'updated_at'=>now()],


            //Autre
            ['id'=>45,'jour_id'=>8, 'heures'=>'1000000000', 'contrainte_id'=>4, 'created_at'=> now(),'updated_at'=>now()],
            ]);
    }
}
