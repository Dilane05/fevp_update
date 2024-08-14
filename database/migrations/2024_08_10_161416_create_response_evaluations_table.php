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
        Schema::create('response_evaluations', function (Blueprint $table) {
            $table->id();
            $table->json('bilan_resultat')->nullable();
            $table->double('note_bilan_resultat')->nullable();
            $table->json('tenue_global')->nullable();
            $table->double('note_tenue_global')->nullable();
            $table->json('manegerial_quality')->nullable();
            $table->double('note_mangeriale_quality')->nullable();
            $table->json('compliance_corporate')->nullable();
            $table->double('note_compliance_resultat')->nullable();
            $table->json('bonus_malus')->nullable();
            $table->double('note_bonus_malus')->nullable();
            $table->json('sanction')->nullable();
            $table->double('note_sanction')->nullable();
            $table->json('other')->nullable();
            $table->double('note_other')->nullable();
            $table->date('date')->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('evaluation_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('response_evaluations');
    }
};
