<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents_candidature', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained('candidatures_master')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('type_document', 100);
            $table->string('nom_fichier', 255);
            $table->string('chemin_fichier', 500);
            $table->string('extension', 20)->nullable();
            $table->unsignedBigInteger('taille')->nullable();
            $table->boolean('obligatoire')->default(true);
            $table->boolean('valide')->default(false);
            $table->text('commentaire')->nullable();
            $table->dateTime('uploaded_at')->nullable();
            $table->dateTime('validated_at')->nullable();
            $table->timestamps();

            $table->index('type_document', 'idx_document_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents_candidature');
    }
};
