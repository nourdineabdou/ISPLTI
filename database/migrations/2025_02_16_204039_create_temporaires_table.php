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
        Schema::create('temporaires', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('caisse_id')->constrained('caisses')->onDelete('cascade');
            $table->userActions();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporaires');
    }
};
