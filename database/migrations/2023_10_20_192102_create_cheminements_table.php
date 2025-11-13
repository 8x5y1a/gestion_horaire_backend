<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @author Mathieu Lahaie-Richer
     */
    public function up(): void
    {
        Schema::create('cheminements', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('option');
            $table->foreignId('horaire_id');
            $table->timestamps();
            $table->foreign('horaire_id')->references('id')->on('horaires')->onDelete('cascade');
        });

        Schema::create('cheminement_cours', function (Blueprint $table) {
            $table->foreignId('cheminement_id');
            $table->foreignId('cours_id');
            $table->timestamps();

            $table->primary(['cheminement_id', 'cours_id']);
            $table->foreign('cheminement_id')->references('id')->on('cheminements')->onDelete('cascade');
            $table->foreign('cours_id')->references('id')->on('cours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cheminements');
        Schema::dropIfExists('cheminement_cours');
    }
};
