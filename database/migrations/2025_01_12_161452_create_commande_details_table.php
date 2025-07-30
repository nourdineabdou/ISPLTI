<?php

use App\Models\Commande;
use App\Models\Product;
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
        Schema::create('commande_details', function (Blueprint $table) {
            $table->id(); // bigint UNSIGNED NOT NULL AUTO_INCREMENT (clé primaire)
            $table->foreignId('commande_id')->constrained()->onDelete('cascade'); // Clé étrangère vers commandes
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Clé étrangère vers produits
            $table->foreignId('fournisseur_id')->nullable()->constrained()->onDelete('set null'); // Clé étrangère vers fournisseurs
            $table->integer('qte')->nullable();
            $table->decimal('prix_total', 10, 2)->nullable();

            // Ajout des colonnes spécifiques
            //$table->foreignId('emballage_id')->nullable()->constrained()->onDelete('set null');
            //$table->foreignIdFor(Emballage::class); // stock_id
            $table->integer('emballage_id');
            $table->integer('nb_produit')->nullable();

            $table->float('mesure')->nullable();
            //$table->integer('nb_produit')->nullable();
            $table->userActions();

            // Timestamps (created_at, updated_at, deleted_at)
            $table->timestamps();
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_details');
    }
};
