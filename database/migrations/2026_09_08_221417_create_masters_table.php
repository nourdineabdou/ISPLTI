<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

        DB::table('masters')->insert([
            'id' => 1,
            'code' => 'TTCN',
            'intitule' => 'Technologies de la Traduction et Communication Numérique',
            'annee_universitaire' => '2026/2027',
            'campus' => 'Nouadhibou',
            'description' => 'Master interdisciplinaire combinant expertise linguistique, traduction, interprétation, communication numérique et technologies de la traduction.',
            'date_debut_candidature' => '2026-09-08',
            'date_fin_candidature' => '2026-09-29',
            'statut' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('masters');
    }
};
