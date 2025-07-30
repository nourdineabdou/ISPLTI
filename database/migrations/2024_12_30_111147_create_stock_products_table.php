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
        Schema::create('stock_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\EmballagesProduit::class);
            $table->foreignIdFor(\App\Models\Stock::class);
            $table->foreignIdFor(\App\Models\EtatStock::class)->nullable();
            $table->float('qte');
            $table->float('mesure')->nullable();
            $table->integer('nb_unite')->default(1);
            $table->float('reste_produit')->nullable();
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
        Schema::dropIfExists('stock_products');
    }
};
