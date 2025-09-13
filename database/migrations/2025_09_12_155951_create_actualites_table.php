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
        Schema::create('actualites', function (Blueprint $table) {
            $table->id();
            $table->string('titre_fr', 255);
            $table->text('titre_en')->nullable();
            $table->text('titre_ar')->nullable();
            $table->text('contenu_fr');
            $table->text('contenu_en')->nullable();
            $table->text('contenu_ar')->nullable();
            $table->date('date_publication');
            $table->string('auteur', 100)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('lien', 255)->nullable();
            $table->string('fichier', 255)->nullable();
            $table->enum('statut', ['publie', 'brouillon'])->default('publie');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actualites');
    }
};
