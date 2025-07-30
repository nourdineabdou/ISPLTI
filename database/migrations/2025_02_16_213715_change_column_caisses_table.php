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
        Schema::table('caisses', function (Blueprint $table) {
            // make the column 'montant' nullable
            $table->float('montant')->nullable()->change();
            // make user_id nullable
            //$table->foreignId('user_id')->nullable()->change();
            // remove payment_method_id
            //$table->dropColumn('payment_method_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('caisses', function (Blueprint $table) {
            // make the column 'montant' NOT NULL
            $table->float('montant')->change();
            // make user_id NOT NULL
            $table->foreignId('user_id')->change();
            // remove payment_method_id
        });
    }
};
