<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lettres_motivation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->unique()->constrained('candidatures_master')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('contenu')->nullable();
            $table->string('fichier', 255)->nullable();
            $table->boolean('signee')->default(false);
            $table->dateTime('date_depot')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lettres_motivation');
    }
};
