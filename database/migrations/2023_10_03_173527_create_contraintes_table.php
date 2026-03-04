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
        Schema::create('contraintes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('type_contrainte_id');
            $table->string('type_description')->default('')->nullable();
            $table->boolean('stricte');
            $table->integer('session')->nullable();
            $table->timestamps();

            $table->foreign('type_contrainte_id')->references('id')->on('type_contraintes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contraintes');
    }
};
