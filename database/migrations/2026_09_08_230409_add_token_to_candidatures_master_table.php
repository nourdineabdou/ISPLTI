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
            $table->string('token', 64)->nullable()->unique()->after('numero_candidature');
            $table->timestamp('token_expire_at')->nullable()->after('token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidatures_master', function (Blueprint $table) {
            $table->dropColumn(['token', 'token_expire_at']);
        });
    }
};
