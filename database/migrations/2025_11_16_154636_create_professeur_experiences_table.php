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
        Schema::create('professeur_experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('professeur_id');
            $table->string('job_title', 150);
            $table->string('institution', 200);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('responsibilities')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professeur_experiences');
    }
};
