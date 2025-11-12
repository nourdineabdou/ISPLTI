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
        Schema::create('absences', function (Blueprint $table) {
               $table->id(); // Cela crée un champ `id` auto-incrémenté
            $table->string('matrucle', 15)->nullable();
            $table->string('jour', 10)->nullable();
            $table->string('matiere', 40)->nullable();
            $table->string('specialite', 10)->nullable();
            $table->string('semestre', 10)->nullable();
            $table->string('semaine', 4)->nullable();
            $table->string('horaire', 10)->nullable();
            $table->string('date', 20)->nullable();
            $table->timestamps(0); // Cela va créer les colonnes `created_at` et `updated_at`
            $table->softDeletes(); // Cela va créer la colonne `deleted_at` pour les suppressions douces
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
