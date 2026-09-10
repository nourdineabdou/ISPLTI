<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entretiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained('candidatures_master')->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('date_entretien')->nullable();
            $table->string('mode', 50)->nullable();
            $table->string('lieu', 255)->nullable();
            $table->string('statut', 50)->default('programme');
            $table->decimal('note', 5, 2)->nullable();
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entretiens');
    }
};
