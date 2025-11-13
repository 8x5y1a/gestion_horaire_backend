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
        Schema::create('bloc_cours', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('jour')->nullable();
            $table->string('heures')->nullable();
            $table->integer('dure')->nullable();

            $table->unsignedBigInteger('local_id')->nullable();
            $table->foreign('local_id')->references('id')->on('locaux')->nullOnDelete();

            $table->unsignedBigInteger('groupe_cours_id')->nullable();
            $table->foreign('groupe_cours_id')->references('id')->on('groupe_cours')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloc_cours');
    }
};
