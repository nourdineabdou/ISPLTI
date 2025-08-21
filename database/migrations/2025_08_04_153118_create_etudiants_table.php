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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nodos', 10);
            $table->string('nom_ar')->nullable();
            $table->string('nom_fr')->nullable();
            $table->string('lieu_naissance_ar')->nullable();
            $table->string('lieu_naissance_fr')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('genre')->nullable();
            $table->string('telephone')->nullable();

            $table->string('situation_familiale_id')->nullable();
            $table->string('nationalite')->nullable();
            $table->boolean('etat_bourse')->default(false);

            $table->string('date_ajout')->nullable();
            $table->string('date_maj')->nullable();

            $table->string('personnel_id')->nullable();
            $table->string('photo')->nullable();
            $table->string('adresse')->nullable();
            $table->string('nni')->nullable();
            $table->string('num_bac')->nullable();

            $table->string('etablissement_id', 8)->nullable();
            $table->string('email')->nullable();
            $table->string('annee_entree_etabliss', 10)->nullable();

            $table->string('num_derogation', 10)->nullable();
            $table->date('date_derogation')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Relations de clés étrangères (optionnel si tu as les tables correspondantes)
            // $table->foreign('groupe_id')->references('id')->on('groupes');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
