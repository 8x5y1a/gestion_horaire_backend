<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * @author Mathieu Lahaie-Richer
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('code');
            $table->string('ponderation');
            $table->string('bloc');
            $table->boolean('local_technique');
            $table->boolean('cours_charge');
            $table->unsignedBigInteger('session');
            $table->timestamps();

            //Pour si vous-voulez la table session
            //$table->unsignedBigInteger('session_id')->nullable();
            //$table->foreign('session_id')->references('id')->on('sessions')->nullOnDelete();
        });

        Schema::create('contrainte_cours', function (Blueprint $table) {
            $table->foreignId('contrainte_id');
            $table->foreignId('cours_id');
            $table->timestamps();

            //Définir la clé primaire
            $table->primary(['contrainte_id', 'cours_id']);
            //Définir les clés étrangères
            $table->foreign('contrainte_id')->references('id')->on('contraintes')->onDelete('cascade');
            $table->foreign('cours_id')->references('id')->on('cours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours');
        Schema::dropIfExists('contrainte_cours');
    }
};
