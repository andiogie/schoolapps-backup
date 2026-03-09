<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan seeder SANGAT PENTING untuk menjaga relasi data.
        $this->call([
            // 1. Master data yang tidak memiliki ketergantungan
            MapelSeeder::class,
            JurusanSeeder::class,
            TahunAjaranSeeder::class,
            AdminSeeder::class,

            // 2. Data yang bergantung pada master data di atas
            GuruSeeder::class, // Harus dijalankan sebelum ProfilSekolahSeeder
            ProfilSekolahSeeder::class, // Sekarang bergantung pada GuruSeeder
            KelasSeeder::class,

            // 3. Data pendaftaran (bergantung pada Jurusan & Admin)
            PendaftaranSeeder::class,
            
            // 4. Data siswa (bisa bergantung pada KelasSeeder atau PendaftaranSeeder)
            SiswaSeeder::class,

            // 5. Seeder transaksional
            AbsensiGuruSeeder::class,
        ]);
    }
}
