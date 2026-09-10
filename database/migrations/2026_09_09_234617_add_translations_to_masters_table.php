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
        Schema::table('masters', function (Blueprint $table) {
            $table->string('intitule_ar', 255)->nullable()->after('intitule');
            $table->string('intitule_en', 255)->nullable()->after('intitule_ar');
            $table->text('description_ar')->nullable()->after('description');
            $table->text('description_en')->nullable()->after('description_ar');
        });

        // la traduction du master TTCN est peuplee a part via :
        // php artisan db:seed --class=CandidatureFeatureSeeder
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('masters', function (Blueprint $table) {
            $table->dropColumn(['intitule_ar', 'intitule_en', 'description_ar', 'description_en']);
        });
    }
};
