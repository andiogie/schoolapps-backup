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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran')->unique();
            
            // Data Diri Siswa
            $table->string('nama_lengkap');
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama', 50);
            $table->string('alamat', 500);
            $table->string('no_hp', 20); // DIPERPANJANG
            $table->string('email')->unique();

            // Data Orang Tua
            $table->string('nomor_kk', 16)->unique();
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah', 100);
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu', 100);
            $table->string('no_hp_ortu', 20); // DIPERPANJANG

            // Data Akademik & Dokumen
            $table->string('asal_sekolah', 100);
            $table->string('jurusan', 100);
            $table->string('ijazah_path');

            // Informasi Pembayaran
            $table->decimal('total_biaya', 10, 2)->default(500000.00);
            $table->decimal('total_bayar', 10, 2)->default(0.00);
            $table->enum('status_pembayaran', ['belum_bayar', 'menunggu_verifikasi', 'cicilan', 'lunas', 'ditolak'])->default('belum_bayar');
            $table->string('bukti_pembayaran_path')->nullable();

            // Status Pendaftaran
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('catatan')->nullable();

            // Audit Trail Columns
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('admins')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
