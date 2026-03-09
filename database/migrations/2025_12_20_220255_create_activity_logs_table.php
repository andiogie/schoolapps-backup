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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // Relasi Polimorfik untuk "Causer" (Penyebab Aksi)
            // Ini akan membuat kolom `causer_id` dan `causer_type`
            $table->nullableMorphs('causer');

            // Relasi Polimorfik untuk model yang diaudit
            $table->morphs('auditable');

            $table->string('action');
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
