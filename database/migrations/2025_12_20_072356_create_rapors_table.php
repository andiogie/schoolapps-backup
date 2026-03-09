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
        Schema::create('rapors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            // Mengganti nama kolom agar konsisten menjadi wali_kelas_id
            $table->foreignId('wali_kelas_id')->constrained('gurus')->onDelete('cascade');
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajarans')->onDelete('cascade');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->enum('status', ['lulus', 'tidak_lulus'])->nullable();
            // Mengganti nama kolom agar konsisten menjadi catatan_wali_kelas
            $table->text('catatan_wali_kelas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapors');
    }
};
