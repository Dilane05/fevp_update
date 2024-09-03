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
        Schema::create('population_cible_comitees', function (Blueprint $table) {
            $table->id();
            // Ajout des colonnes en utilisant unsignedBigInteger et nullable
            $table->unsignedBigInteger('comitee_calibrage_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('occupation_id')->nullable();

            // Définition des clés étrangères avec cascade onDelete
            $table->foreign('comitee_calibrage_id')->references('id')->on('comitee_calibrages')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('occupation_id')->references('id')->on('occupations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('population_cible_comitees');
    }
};
