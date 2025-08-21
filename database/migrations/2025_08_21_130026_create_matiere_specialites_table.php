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
        Schema::create('matiere_specialites', function (Blueprint $table) {
            $table->id();

            $table->foreignId('matiere_id')->constrained('matieres')->cascadeOnDelete();
            $table->string('elementprfl_id', 20)->nullable();
            $table->foreignId('module_id')->nullable()->constrained('modules')->nullOnDelete();
            $table->foreignId('specialite_id')->nullable()->constrained('specialites')->nullOnDelete();
            $table->foreignId('semestre_id')->nullable()->constrained('semestres')->nullOnDelete();
            $table->foreignId('annee_univ_id')->constrained('annee_univs')->cascadeOnDelete();

            $table->double('credit')->default(0);
            $table->double('coefficient');
            $table->integer('prerequis');
            $table->boolean('etat_suppression')->default(0);
            $table->integer('nb_heure')->default(0);
            $table->float('h_effectuer');
            $table->string('etablissement_id', 8);
            $table->integer('indic')->default(0);
            $table->string('lib_element_ang', 60);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matiere_specialites');
    }
};
