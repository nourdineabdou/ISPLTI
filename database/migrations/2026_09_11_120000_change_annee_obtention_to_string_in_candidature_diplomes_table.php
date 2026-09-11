<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * La colonne etait de type YEAR (MySQL), limite techniquement a 1901-2155 :
     * toute valeur en dehors de cette plage provoque une erreur SQL brutale (fatale,
     * non rattrapee par la validation) des que la contrainte min/max cote formulaire
     * a ete retiree a la demande du candidat ("laisser lui mettre ce qu'il veut").
     * En VARCHAR, la colonne accepte n'importe quelle saisie sans jamais planter.
     *
     * SQL brut (plutot que Schema::table(...)->change()) : doctrine/dbal n'est pas
     * installe dans ce projet.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE candidature_diplomes MODIFY annee_obtention VARCHAR(20) NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE candidature_diplomes MODIFY annee_obtention YEAR NULL');
    }
};
