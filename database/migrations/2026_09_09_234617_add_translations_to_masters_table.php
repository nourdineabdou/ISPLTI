<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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

        // traduction du master deja existant (TTCN)
        DB::table('masters')->where('code', 'TTCN')->update([
            'intitule_ar' => 'تقنيات الترجمة والاتصال الرقمي',
            'intitule_en' => 'Translation Technologies and Digital Communication',
            'description_ar' => 'ماستر متعدد التخصصات يجمع بين الخبرة اللغوية والترجمة والترجمة الفورية والاتصال الرقمي وتقنيات الترجمة.',
            'description_en' => "An interdisciplinary Master's program combining linguistic expertise, translation, interpreting, digital communication, and translation technologies.",
        ]);
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
