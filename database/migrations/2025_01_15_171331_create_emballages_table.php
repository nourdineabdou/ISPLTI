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
        Schema::create('emballages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_emballage_id')->nullable();
            $table->float('mesure')->nullable(); // Assurez-vous que cette ligne existe
            $table->integer('nombre')->default(1);
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
        Schema::dropIfExists('emballages');
    }
};
