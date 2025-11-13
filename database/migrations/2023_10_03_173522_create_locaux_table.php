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
        Schema::create('locaux', function (Blueprint $table) {
            $table->id();
            $table->string("no_local");
            $table->integer("capacite");
            $table->boolean("local_technique");
            $table->foreignId('horaire_id');
            $table->timestamps();
            $table->foreign('horaire_id')->references('id')->on('horaires')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locaux');
    }
};
