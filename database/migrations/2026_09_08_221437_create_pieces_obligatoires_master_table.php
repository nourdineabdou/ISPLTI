<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

        // les pieces obligatoires de reference sont peuplees a part via :
        // php artisan db:seed --class=CandidatureFeatureSeeder
    }

    public function down(): void
    {
        Schema::dropIfExists('pieces_obligatoires_master');
    }
};
