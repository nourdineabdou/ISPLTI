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
        Schema::create('inscription_pdgs', function (Blueprint $table) {
             $table->id();

            $table->unsignedBigInteger('etudiant_id')->nullable();
            $table->unsignedBigInteger('semestre_id')->nullable();
            $table->unsignedBigInteger('specialite_id')->nullable();
            $table->unsignedBigInteger('annee_univ_id')->nullable();
            $table->unsignedBigInteger('matiere_id')->nullable();
            $table->unsignedBigInteger('module_id')->nullable();

            $table->tinyInteger('nb_inscription')->default(1);
            $table->integer('annee_premiere_attribution')->default(0);

            $table->float('credit')->default(0);
            $table->integer('nb_heure')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscription_pdgs');
    }
};
