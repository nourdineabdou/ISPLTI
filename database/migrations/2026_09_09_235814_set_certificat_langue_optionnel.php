<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // un candidat peut ne pas avoir de certificat de langue : on ne l'exige plus
        DB::table('pieces_obligatoires_master')
            ->where('code_document', 'certificat_langue')
            ->update(['obligatoire' => false]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('pieces_obligatoires_master')
            ->where('code_document', 'certificat_langue')
            ->update(['obligatoire' => true]);
    }
};
