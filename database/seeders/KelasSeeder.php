<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil satu guru secara acak yang BUKAN kepala sekolah untuk dijadikan wali kelas.
        // Ini jauh lebih aman daripada hardcode NIP.
        $waliKelas = Guru::where('is_kepala_sekolah', false)->inRandomOrder()->first();

        $kelasData = [
            // Kelas untuk TKJ (jurusan_id = 1)
            ['nama_kelas' => '10-TKJ-1', 'jurusan_id' => 1, 'wali_kelas_id' => $waliKelas->id ?? null, 'is_active' => true],
            ['nama_kelas' => '11-TKJ-1', 'jurusan_id' => 1, 'wali_kelas_id' => null, 'is_active' => true],
            ['nama_kelas' => '12-TKJ-1', 'jurusan_id' => 1, 'wali_kelas_id' => null, 'is_active' => true],

            // Kelas untuk RPL (jurusan_id = 2)
            ['nama_kelas' => '10-RPL-1', 'jurusan_id' => 2, 'wali_kelas_id' => null, 'is_active' => true],
            ['nama_kelas' => '11-RPL-1', 'jurusan_id' => 2, 'wali_kelas_id' => null, 'is_active' => true],
            ['nama_kelas' => '12-RPL-1', 'jurusan_id' => 2, 'wali_kelas_id' => null, 'is_active' => true],

            // Kelas untuk Akuntansi (jurusan_id = 3)
            ['nama_kelas' => '10-AK-1', 'jurusan_id' => 3, 'wali_kelas_id' => null, 'is_active' => true],
            ['nama_kelas' => '11-AK-1', 'jurusan_id' => 3, 'wali_kelas_id' => null, 'is_active' => true],
            ['nama_kelas' => '12-AK-1', 'jurusan_id' => 3, 'wali_kelas_id' => null, 'is_active' => true],
        ];

        foreach ($kelasData as $data) {
            Kelas::create($data);
        }
    }
}
