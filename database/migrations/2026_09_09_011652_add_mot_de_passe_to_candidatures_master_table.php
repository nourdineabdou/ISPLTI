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
        Schema::table('candidatures_master', function (Blueprint $table) {
            $table->string('mot_de_passe', 255)->nullable()->after('token_expire_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidatures_master', function (Blueprint $table) {
            $table->dropColumn('mot_de_passe');
        });
    }
};
