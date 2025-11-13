<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            $table->string('nom');
            $table->string('bureau')->nullable();
            $table->string('poste')->nullable();
            $table->string('adresse_courriel');
            $table->string('role');
            $table->foreignId('user_id');
            $table->foreignId('horaire_id');

            $table->foreign('horaire_id')->references('id')->on('horaires')->onDelete('cascade');
            $table->foreign('user_id')-> references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

        });

        Schema::create('contrainte_personnel', function (Blueprint $table) {
            $table->foreignId('contrainte_id');
            $table->foreignId('personnel_id');
            $table->timestamps();

            //Définir la clé primaire
            $table->primary(['contrainte_id', 'personnel_id']);
            //Définir les clés étrangères
            $table->foreign('contrainte_id')->references('id')->on('contraintes')->onDelete('cascade');
            $table->foreign('personnel_id')->references('id')->on('personnels')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
        Schema::dropIfExists('contrainte_personnel');
    }
};
