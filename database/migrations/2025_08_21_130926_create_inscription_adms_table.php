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
        Schema::create('inscription_adms', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('etudiant_id')->nullable();
            $table->unsignedTinyInteger('semestre_id')->nullable();
            $table->unsignedBigInteger('specialite_id')->nullable();
            $table->unsignedBigInteger('annee_univ_id');
            $table->unsignedInteger('groupe_id')->nullable();

            $table->dateTime('date_inscription')->nullable();
            $table->dateTime('date_maj')->nullable();

            $table->unsignedTinyInteger('etat_etudiant_id')->nullable();
            $table->unsignedTinyInteger('type_paiement_id')->nullable();
            $table->unsignedTinyInteger('type_inscription_id')->nullable();

            $table->boolean('carte_imprimer')->default(false);
            $table->unsignedBigInteger('personnel_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscription_adms');
    }
};
