<?php

use App\Models\Auth\User;
use App\Models\Meal;
use App\Models\Serveur;
use App\Models\Table;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignIdFor(User::class, 'client_id')->nullable();
            $table->foreignIdFor(Serveur::class, 'serveur_id')->nullable();
            $table->foreignIdFor(Table::class, 'table_id')->nullable();
            $table->foreignIdFor(User::class, 'livreur_id')->nullable();
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->decimal('total', 10, 2)->default(0);
            $table->enum('payment_status', ['pending', 'paid', 'half-paid', 'refunded', 'cancelled'])->default('pending');
            $table->text('note')->nullable();
            $table->text('cancel_reason')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
