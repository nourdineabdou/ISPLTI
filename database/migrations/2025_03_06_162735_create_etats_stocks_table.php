<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtatsStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etats_stocks', function (Blueprint $table) {
            $table->id(); // Ceci crée une colonne `id` auto-incrémentée et clé primaire
            $table->date('date')->nullable(false); // Colonne `date` de type date, non nullable
            $table->timestamps(); // Ceci crée les colonnes `created_at` et `updated_at`
            $table->softDeletes(); // Ceci crée la colonne `deleted_at` pour le soft delete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etats_stocks');
    }
}
