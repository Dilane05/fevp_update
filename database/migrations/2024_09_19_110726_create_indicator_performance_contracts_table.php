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
        Schema::create('indicator_performance_contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('performance_contrat_id');  // Clé étrangère pour lier à la table objectifs
            $table->string('nom')->nullable();
            $table->string('type')->nullable();
            $table->string('cible')->nullable();
            $table->float('coef')->nullable();
            $table->string('frequence')->nullable();
            $table->string('mode_calcul')->nullable();
            $table->string('observations')->nullable();
            // Clé étrangère
            $table->foreign('performance_contrat_id')->references('id')->on('performance_contrats')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicator_performance_contracts');
    }
};
