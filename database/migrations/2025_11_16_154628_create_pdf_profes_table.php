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
        Schema::create('pdf_profes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('matiere_id')->nullable();
            $table->integer('specialite_id')->nullable();
            // Dans ton SQL c'était INT, mais normalement un chemin PDF = string
            $table->string('chemain_pde')->nullable();
            $table->integer('active')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdf_proves');
    }
};
