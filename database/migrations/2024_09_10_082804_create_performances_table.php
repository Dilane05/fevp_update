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
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tbord_id')->constrained()->onDelete('cascade');
            $table->string('objectif');
            $table->string('indicateur');
            $table->string('type_indicator')->nullable();
            $table->json('performances')->nullable();
            $table->decimal('cible', 5, 2); // Valeur cible
            $table->decimal('coef', 5, 2);  // Coefficient
            $table->float(10,2,'note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};
