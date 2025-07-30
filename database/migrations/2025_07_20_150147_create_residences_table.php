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
        // migration
        Schema::create('residences', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->enum('type', ['simple', 'double', 'suite'])->default('simple');
            $table->integer('capacite');
            $table->decimal('prix', 10, 2);
            $table->text('description')->nullable();
            $table->enum('statut', ['disponible', 'occupée', 'nettoyage', 'réservée'])->default('disponible');
            $table->integer('etage')->nullable();

            // Équipements
            $table->boolean('has_clim')->default(false);
            $table->boolean('has_tv')->default(false);
            $table->boolean('has_wifi')->default(false);
            $table->boolean('has_douche')->default(true);
            $table->timestamps();
            $table->softDeletes();

    });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residences');
    }
};
