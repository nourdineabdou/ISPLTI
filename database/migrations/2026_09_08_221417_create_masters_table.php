<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masters', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('intitule', 255);
            $table->string('annee_universitaire', 20);
            $table->string('campus', 255)->default('Nouadhibou');
            $table->text('description')->nullable();
            $table->date('date_debut_candidature');
            $table->date('date_fin_candidature');
            $table->boolean('statut')->default(true);
            $table->timestamps();
        });

        // les donnees de reference (master TTCN) sont peuplees a part via :
        // php artisan db:seed --class=CandidatureFeatureSeeder
    }

    public function down(): void
    {
        Schema::dropIfExists('masters');
    }
};
