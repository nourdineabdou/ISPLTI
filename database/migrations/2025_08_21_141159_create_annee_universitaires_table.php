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
        Schema::create('annee_universitaires', function (Blueprint $table) {
            $table->id();

            $table->string('annee_univ_id', 9);
            $table->string('libelle_ann_univ_ar', 150)->nullable();
            $table->string('ann_univ_precedent', 20)->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->boolean('etat')->nullable();
            $table->boolean('etat_suppression')->default(false);
            $table->string('lib_cours', 6)->default('15-16/');
            $table->string('annee_progression', 9);
            $table->string('indc', 2);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annee_universitaires');
    }
};
