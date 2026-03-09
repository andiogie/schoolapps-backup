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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            // HAPUS: Ketergantungan pada tabel users dihilangkan
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->foreignId('pendaftaran_id')->nullable()->unique()->constrained('pendaftarans')->onDelete('set null');
            $table->string('nis')->unique();
            $table->string('nama_siswa');

            // TAMBAH: Kolom untuk autentikasi mandiri
            $table->string('password');
            $table->rememberToken();

            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama', 50);
            $table->string('no_hp', 15)->nullable();
            $table->string('asal_sekolah', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
