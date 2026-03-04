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
        Schema::create('bloc_generaux', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('heures')->nullable();
            $table->integer('dure')->nullable();

            $table->unsignedBigInteger('jour_id')->nullable();
            $table->foreign('jour_id')->references('id')->on('jours')->nullOnDelete();

            $table->unsignedBigInteger('bloc_libre_id');
            $table->foreign('bloc_libre_id')->references('id')->on('bloc_libres')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloc_generaux');
    }
};
