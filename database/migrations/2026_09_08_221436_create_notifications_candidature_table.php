<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications_candidature', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained('candidatures_master')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('type', 50);
            $table->string('objet', 255);
            $table->text('message');
            $table->string('canal', 30)->default('email');
            $table->boolean('lu')->default(false);
            $table->dateTime('date_envoi')->nullable();
            $table->timestamps();

            $table->index('lu', 'idx_notification_lu');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications_candidature');
    }
};
