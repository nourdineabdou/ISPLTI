<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidature_diplomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained('candidatures_master')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('type_diplome', 100);
            $table->string('intitule', 255);
            $table->string('domaine', 255)->nullable();
            $table->string('specialite', 255)->nullable();
            $table->string('etablissement', 255)->nullable();
            $table->string('pays', 100)->nullable();
            $table->year('annee_obtention')->nullable();
            $table->string('mention', 100)->nullable();
            $table->string('fichier_diplome', 255)->nullable();
            $table->string('fichier_releve', 255)->nullable();
            $table->string('fichier_memoire', 255)->nullable();
            $table->string('fichier_rapport', 255)->nullable();
            $table->string('fichier_projet_fin_etudes', 255)->nullable();
            $table->boolean('certifie_conforme')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidature_diplomes');
    }
};
