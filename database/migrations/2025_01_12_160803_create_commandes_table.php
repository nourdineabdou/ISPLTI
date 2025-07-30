<?php

use App\Models\Fournisseur;
use App\Models\Stock;
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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->integer('type_commande')->default(1)->comment('1: entre, 2: sortie,');
            $table->foreignIdFor(Stock::class); // stock_id
            $table->integer('etat_id')->default(1);
            $table->integer('stock_secondaire')->nullable();
            $table->date('date_livraison')->nullable();
            $table->date('date_facture')->nullable();
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
        Schema::dropIfExists('commandes');
    }
};
