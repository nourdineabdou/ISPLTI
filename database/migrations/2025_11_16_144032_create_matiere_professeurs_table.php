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
        Schema::create('matiere_professeurs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('professeur_id')->nullable();
        $table->unsignedBigInteger('matiere_id')->nullable();
        $table->unsignedBigInteger('code_specialite')->nullable();
        $table->integer('active')->default(1);
        $table->string('libelle')->nullable(); // libelle doit être string
        $table->integer('nbreEtudiant')->nullable();
        $table->timestamps();
        $table->softDeletes();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matiere_professeurs');
    }
};
