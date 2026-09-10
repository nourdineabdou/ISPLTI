<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pieces_obligatoires_master', function (Blueprint $table) {
            $table->id();
            $table->foreignId('master_id')->constrained('masters')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('code_document', 100);
            $table->string('libelle', 255);
            $table->boolean('obligatoire')->default(true);
            $table->integer('ordre')->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();

            $table->unique(['master_id', 'code_document'], 'unique_piece_master');
        });

        DB::table('pieces_obligatoires_master')->insert([
            ['id' => 1, 'master_id' => 1, 'code_document' => 'acte_naissance', 'libelle' => 'Extrait d’acte de naissance', 'obligatoire' => true, 'ordre' => 1, 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'master_id' => 1, 'code_document' => 'certificat_nationalite', 'libelle' => 'Certificat de nationalité', 'obligatoire' => true, 'ordre' => 2, 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'master_id' => 1, 'code_document' => 'carte_identite', 'libelle' => 'Copie de la carte nationale d’identité', 'obligatoire' => true, 'ordre' => 3, 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'master_id' => 1, 'code_document' => 'diplome', 'libelle' => 'Copie certifiée conforme des diplômes', 'obligatoire' => true, 'ordre' => 4, 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'master_id' => 1, 'code_document' => 'releve_notes', 'libelle' => 'Relevés de notes', 'obligatoire' => true, 'ordre' => 5, 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'master_id' => 1, 'code_document' => 'memoire_rapport_projet', 'libelle' => 'Mémoire, rapport ou projet de fin d’études', 'obligatoire' => true, 'ordre' => 6, 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'master_id' => 1, 'code_document' => 'certificat_formation', 'libelle' => 'Certificat de formation', 'obligatoire' => false, 'ordre' => 7, 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'master_id' => 1, 'code_document' => 'certificat_langue', 'libelle' => 'Certificat de langue', 'obligatoire' => true, 'ordre' => 8, 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'master_id' => 1, 'code_document' => 'certificat_travail', 'libelle' => 'Certificat de travail', 'obligatoire' => false, 'ordre' => 9, 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'master_id' => 1, 'code_document' => 'projet_recherche', 'libelle' => 'Projet de recherche de 3 à 6 pages', 'obligatoire' => true, 'ordre' => 10, 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'master_id' => 1, 'code_document' => 'lettre_motivation', 'libelle' => 'Lettre de motivation signée', 'obligatoire' => true, 'ordre' => 11, 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('pieces_obligatoires_master');
    }
};
