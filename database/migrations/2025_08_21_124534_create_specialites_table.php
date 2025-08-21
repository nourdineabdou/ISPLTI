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
        Schema::create('specialites', function (Blueprint $table) {
           $table->id(); // id auto-incrément

            $table->string('annee_diplome_id', 8);
            $table->string('diplome_id', 8)->nullable();
            $table->string('niveau', 2)->nullable();

            $table->string('lib_annee_diplome_ar', 160)->nullable();
            $table->string('lib_annee_diplome_fr', 80)->nullable();

            $table->double('total_credit')->nullable();
            $table->string('option_an_diplome', 2)->default('A');

            $table->foreignId('annee_univ_id')->nullable()->constrained('annees_univ')->nullOnDelete();
            $table->boolean('etat_suppression')->default(0);
            $table->boolean('session')->default(0);

            $table->string('etablissement_id', 8);
            $table->integer('montant_frais')->default(0);
            $table->integer('semestre')->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialites');
    }
};
