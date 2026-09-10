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
        Schema::create('actualite_videos', function (Blueprint $table) {
            $table->id();
            $table->integer('actualite_id');
            $table->foreign('actualite_id')->references('id')->on('actualites')->cascadeOnDelete();
            $table->string('chemin', 255);
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actualite_videos');
    }
};
