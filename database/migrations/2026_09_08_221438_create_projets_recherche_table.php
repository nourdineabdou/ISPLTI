<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projets_recherche', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained('candidatures_master')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('titre', 500);
            $table->string('discipline', 255)->nullable();
            $table->text('resume')->nullable();
            $table->string('fichier_projet', 255);
            $table->integer('nombre_pages')->nullable();
            $table->dateTime('date_depot')->nullable();
            $table->string('statut', 50)->default('depose');
            $table->decimal('note', 5, 2)->nullable();
            $table->text('observation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projets_recherche');
    }
};
