<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Cette migration ne modifie plus de donnees : le caractere facultatif du
     * certificat de langue est desormais defini directement dans le seeder
     * CandidatureFeatureSeeder (obligatoire => false). Conservee vide pour ne
     * pas casser l'historique des migrations deja executees.
     */
    public function up(): void
    {
        //
    }

    public function down(): void
    {
        //
    }
};
