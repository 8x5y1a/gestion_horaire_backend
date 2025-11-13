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
        Schema::create('groupe_cours', function (Blueprint $table) {
            $table->id();
            $table->integer('nbEtud');
            $table->integer('groupe');
            $table->unsignedBigInteger('campus_id')->nullable();
            $table->unsignedBigInteger('cours_id')->nullable();
            $table->unsignedBigInteger('personnel_id')->nullable();
            $table->timestamps();

            $table->foreign('campus_id')->references('id')->on('campus')->nullOnDelete();
            $table->foreign('cours_id')->references('id')->on('cours')->nullOnDelete();
            $table->foreign('personnel_id')->references('id')->on('personnels')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupe_cours');
    }
};
