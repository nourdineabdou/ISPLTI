<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('langues', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('langue', 100);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });

        DB::table('langues')->insert([
            ['id' => 1, 'code' => 'AR', 'langue' => 'Arabe', 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'code' => 'EN', 'langue' => 'Anglais', 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'code' => 'FR', 'langue' => 'Français', 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'code' => 'ES', 'langue' => 'Espagnol', 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'code' => 'TR', 'langue' => 'Turc', 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'code' => 'ZH', 'langue' => 'Chinois', 'actif' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('langues');
    }
};
