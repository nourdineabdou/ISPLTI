<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidature_langues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained('candidatures_master')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('langue_id')->constrained('langues')->cascadeOnUpdate();
            $table->string('niveau', 10);
            $table->string('type', 30)->default('langue_travail');
            $table->string('certificat_langue', 255)->nullable();
            $table->string('fichier_certificat', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidature_langues');
    }
};
