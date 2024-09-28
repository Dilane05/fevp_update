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
        Schema::create('performance_contrats', function (Blueprint $table) {
            $table->id();
            $table->string('valeur');
            $table->unsignedBigInteger('performance_contract_id');  // Clé étrangère pour lier à la table objectifs
            $table->foreign('performance_contract_id')->references('id')->on('performance_contracts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_contrats');
    }
};
