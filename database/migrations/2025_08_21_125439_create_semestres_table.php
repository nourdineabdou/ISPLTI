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
        Schema::create('semestres', function (Blueprint $table) {
              $table->id();

            $table->string('semestre_code', 2); // ancien id_semestre
            $table->string('lib_semestre_ar', 150)->nullable();
            $table->string('lib_semestre_fr', 60)->nullable();

            $table->integer('credit_total')->nullable();
            $table->boolean('etat_suppression')->default(0);
            $table->integer('niveau');
            $table->string('etat', 2);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semestres');
    }
};
