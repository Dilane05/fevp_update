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
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom de l'indicateur (performance, execution, budget)
            $table->float('min_value'); // Valeur minimale pour la condition
            $table->float('max_value'); // Valeur maximale pour la condition
            $table->float('min_score'); // Score minimal pour la condition
            $table->float('max_score'); // Score maximal pour la condition
            $table->string('condition_type'); // Type de condition (e.g., 'range')
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicators');
    }
};
