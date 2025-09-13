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
        Schema::create('professeurs', function (Blueprint $table) {
             $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('nom')->nullable();
                $table->string('specialite')->nullable();
                $table->string('image')->nullable();
                $table->string('nni')->nullable();
                $table->string('prenom')->nullable();
                $table->string('cv')->nullable();
                $table->string('telephone')->nullable();
                $table->timestamps();
                $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professeurs');
    }
};
