<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat 50 guru dengan data acak menggunakan factory.
        Guru::factory(50)->create();

        // 2. Ambil guru pertama yang ada di database.
        $calonKepalaSekolah = Guru::first();

        // 3. Jika ada guru, tetapkan dia sebagai Kepala Sekolah.
        if ($calonKepalaSekolah) {
            $calonKepalaSekolah->is_kepala_sekolah = true;
            $calonKepalaSekolah->mapel_id = null; // Kepala sekolah tidak wajib mengajar mapel tertentu
            $calonKepalaSekolah->save();
        }
    }
}
