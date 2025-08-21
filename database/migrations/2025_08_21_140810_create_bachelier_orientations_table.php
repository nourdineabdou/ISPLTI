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
        Schema::create('bachelier_orientations', function (Blueprint $table) {
            $table->id();

            $table->string('bachelier_id', 7);
            $table->string('nom_ar', 100)->nullable();
            $table->string('nom_fr', 100)->nullable();
            $table->date('datn')->nullable();
            $table->string('lieun', 20)->nullable();
            $table->string('lieuna', 20)->nullable();
            $table->string('num_bac', 9)->nullable();
            $table->string('serie_id', 3)->nullable();
            $table->string('centre_examen', 30)->nullable();
            $table->string('centre_scolorisation', 30)->nullable();
            $table->string('session_bac', 2)->nullable();
            $table->string('type_candidat', 2)->nullable();
            $table->string('annee_bac', 4)->default('2024');
            $table->double('moyenne_bac_g1')->nullable();
            $table->double('moyenne_bac_g2')->nullable();
            $table->double('moyenne_bac')->nullable();
            $table->string('profil_orientation', 8)->nullable();
            $table->string('lib_profil_orientation', 255)->default(' ');
            $table->string('etab_profil_orientation', 200)->default(' ISPLTI');
            $table->string('genre', 1)->nullable();
            $table->string('nni', 10)->nullable();
            $table->string('tel', 100)->nullable();
            $table->string('inscription', 1)->default('3');

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bachelier_orientations');
    }
};
