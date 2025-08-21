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
        Schema::create('etablissements', function (Blueprint $table) {
            $table->id();

            $table->string('lib_etab_ar', 150)->nullable();
            $table->string('lib_etab_fr', 50)->nullable();
            $table->string('code_etab_ar', 25)->nullable();
            $table->string('code_etab_fr', 25)->nullable();
            $table->string('pres_fix', 10)->default('15-16/');
            $table->integer('dernier_num_etud')->default(0);
            $table->integer('dernier_num_etudfc')->default(0);
            $table->integer('nbr_semestres_autorise_progression')->default(0);
            $table->integer('nbr_credit_autorise_progression')->default(0);
            $table->integer('nbr_modules_autorise_progression')->default(0);
            $table->boolean('utiliser_groupe_immatriculation')->default(false);
            $table->integer('longueur_nodos')->nullable();
            $table->boolean('etat_suppression')->default(false);
            $table->boolean('paiement_frais_par_master')->default(false);
            $table->boolean('utilise_seul_manuel')->default(false);
            $table->integer('nbre_autorise_manuel')->default(0);
            $table->string('signature_chef_scolarite')->nullable();
            $table->string('nom_chef_scolarite_ar')->nullable();
            $table->string('nom_chef_scolarite_fr')->nullable();
            $table->boolean('progression_master_annuel_au_semestriel')->default(false);
            $table->integer('nbrecu')->default(0);
            $table->integer('nbr_recu_br')->default(0);
            $table->integer('nbr_recu_brcns')->default(0);

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};
