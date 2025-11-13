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
        Schema::create('bloc_libres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nb_bloc');
            $table->unsignedBigInteger('nb_heure');
            $table->unsignedBigInteger('contrainte_id');
            $table->timestamps();

            $table->foreign('contrainte_id')->references('id')->on('contraintes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloc_libres');
    }
};
