<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidatures_master', function (Blueprint $table) {
            $table->id();
            $table->foreignId('master_id')->constrained('masters')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('numero_candidature', 50)->unique();
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('sexe', 20)->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance', 255)->nullable();
            $table->string('nationalite', 100)->nullable();
            $table->string('nni', 50)->unique();
            $table->string('telephone', 30)->nullable();
            $table->string('whatsapp', 30)->nullable();
            $table->string('email', 150);
            $table->text('adresse')->nullable();
            $table->string('situation_professionnelle', 100)->nullable();
            $table->string('profession', 150)->nullable();
            $table->string('organisme_employeur', 255)->nullable();
            $table->text('experience_professionnelle')->nullable();
            $table->text('experience_recherche')->nullable();
            $table->string('statut', 50)->default('brouillon');
            $table->dateTime('date_soumission')->nullable();
            $table->text('commentaire_admin')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('nom', 'idx_candidature_nom');
            $table->index('statut', 'idx_candidature_statut');
            $table->index('email', 'idx_candidature_email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidatures_master');
    }
};
