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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            $table->string('nom');
            $table->string('bureau')->nullable();
            $table->string('poste')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('premiere_utilisation')->default(true);
            $table->foreignId('horaire_id');
            $table->rememberToken();

            $table->foreign('horaire_id')->references('id')->on('horaires')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('contrainte_user', function (Blueprint $table) {
            $table->foreignId('contrainte_id');
            $table->foreignId('user_id');
            $table->timestamps();

            //Définir la clé primaire
            $table->primary(['contrainte_id', 'user_id']);
            //Définir les clés étrangères
            $table->foreign('contrainte_id')->references('id')->on('contraintes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('contrainte_user');
    }
};

