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
        Schema::create('modules', function (Blueprint $table) {
   $table->id();

            $table->string('code_module', 10);
            $table->string('lib_module_ar', 200)->nullable();
            $table->string('lib_module_fr', 200)->nullable();

            $table->boolean('etat_suppression')->default(0);
            $table->integer('nb_heure')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
