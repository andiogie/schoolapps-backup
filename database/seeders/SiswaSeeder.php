<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua referensi ke model User.
        // Tambahkan password langsung ke Siswa.

        Siswa::create([
            'pendaftaran_id' => null,
            'nama_siswa' => 'Ahmad Dahlan',
            'nis' => '123456789',
            'password' => Hash::make('password'), // Password default
            'kelas_id' => 1,
            'jurusan_id' => 1,
            'tanggal_lahir' => '2008-01-15',
            'alamat' => 'Jl. Merdeka No. 10, Jakarta',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'no_hp' => '081234567890',
            'asal_sekolah' => 'SMPN 1 Jakarta',
            'is_active' => true,
        ]);

        Siswa::create([
            'pendaftaran_id' => null,
            'nama_siswa' => 'Budi Santoso',
            'nis' => '987654321',
            'password' => Hash::make('password'), // Password default
            'kelas_id' => 2,
            'jurusan_id' => 2,
            'tanggal_lahir' => '2008-05-20',
            'alamat' => 'Jl. Pahlawan No. 25, Surabaya',
            'jenis_kelamin' => 'L',
            'agama' => 'Kristen',
            'no_hp' => '087654321098',
            'asal_sekolah' => 'SMPN 2 Surabaya',
            'is_active' => true,
        ]);

        // Kita bisa gunakan factory untuk data yang lebih banyak
        // Siswa::factory(10)->create();
    }
}
