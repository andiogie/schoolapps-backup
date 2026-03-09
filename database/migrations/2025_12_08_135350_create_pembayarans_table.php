<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajarans')->onDelete('cascade');
            
            $table->year('tahun_spp');
            $table->tinyInteger('bulan_spp'); // 1 = Januari, 2 = Februari, dst.

            $table->decimal('jumlah_bayar', 10, 2);
            $table->enum('tipe_pembayaran', ['Cash', 'QRIS', 'Transfer'])->default('Cash');

            $table->date('tanggal_bayar')->useCurrent();

            $table->text('keterangan')->nullable();

            // PERBAIKAN FINAL (BENAR-BENAR FINAL): Menambahkan kolom Blamable sesuai standar proyek
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
};
