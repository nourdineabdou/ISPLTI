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
        Schema::create('convocations', function (Blueprint $table) {
           $table->id();
            $table->string('matrucle',15)->nullable();
            $table->string('jour',10)->nullable();
            $table->string('matiere',100)->nullable();
            $table->string('specialite',10)->nullable();
            $table->string('semestre',10)->nullable();
            $table->string('tauxpresecce',10)->nullable();
            $table->string('nosalle',10)->nullable();
            $table->string('horaire',40)->nullable();
            $table->string('date',20)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convocations');
    }
};
