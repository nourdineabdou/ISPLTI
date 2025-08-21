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

            $table->integer('matiere_id');
            $table->string('elementprfl_id', 20)->nullable();
            $table->integer('module_id')->nullable();
            $table->integer('specialite_id')->nullable();
            $table->integer('semestre_id')->nullable();
            $table->integer('annee_univ_id');

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
