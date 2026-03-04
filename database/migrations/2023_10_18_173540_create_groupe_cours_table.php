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
            $table->integer('nbetud');
            $table->integer('groupe');
            $table->unsignedBigInteger('campus_id')->nullable();
            $table->unsignedBigInteger('cours_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('couleur');
            $table->timestamps();

            $table->foreign('campus_id')->references('id')->on('campus')->onDelete('cascade');
            $table->foreign('cours_id')->references('id')->on('cours')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
