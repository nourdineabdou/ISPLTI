<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluations_candidature', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained('candidatures_master')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('evaluateur_id')->nullable();
            $table->decimal('note_dossier', 5, 2)->nullable();
            $table->decimal('note_diplome', 5, 2)->nullable();
            $table->decimal('note_langues', 5, 2)->nullable();
            $table->decimal('note_projet_recherche', 5, 2)->nullable();
            $table->decimal('note_motivation', 5, 2)->nullable();
            $table->decimal('note_experience', 5, 2)->nullable();
            $table->decimal('note_entretien', 5, 2)->nullable();
            $table->decimal('note_finale', 5, 2)->nullable();
            $table->string('decision', 50)->nullable();
            $table->text('observation')->nullable();
            $table->dateTime('date_evaluation')->nullable();
            $table->timestamps();

            $table->index('decision', 'idx_evaluation_decision');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluations_candidature');
    }
};
