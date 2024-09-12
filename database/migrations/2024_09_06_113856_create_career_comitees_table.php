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
        Schema::create('career_comitees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('response_evaluation_id')->constrained()->onDelete('cascade');
            $table->string('selected_decision')->nullable();
            $table->text('decision_comment')->nullable();
            $table->text('short_term_evolution')->nullable();
            $table->text('perspective_career')->nullable();
            $table->string('selected_profile')->nullable();
            $table->text('profile_comment')->nullable();
            $table->text('comment_n1')->nullable();
            $table->text('comment_n2')->nullable();
            $table->date('signature_n1_date')->nullable();
            $table->date('signature_n2_date')->nullable();
            $table->date('signature_rrdch_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_comitees');
    }
};
