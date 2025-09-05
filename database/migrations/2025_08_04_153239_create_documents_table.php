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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->nullable();
            $table->foreignId('bachelier_orientation_id')->nullable();
            // enum type
            $table->enum('type', ['releve', 'demande_manu', 'diplome' , 'attestation' , "photo", 'certificat medical' , 'formulaire signe' , "nni" , 'paiement'])->default('attestation');
            $table->string('fichier_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
