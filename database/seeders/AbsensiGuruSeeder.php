<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AbsensiGuru;
use App\Models\Guru;
use Carbon\Carbon;

class AbsensiGuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guru = Guru::first();

        if($guru) {
            for ($i = 0; $i < 5; $i++) {
                $waktu_masuk = Carbon::now()->subDays($i)->setHour(7)->setMinute(rand(0, 30));
                AbsensiGuru::create([
                    'guru_id' => $guru->id,
                    'waktu_masuk' => $waktu_masuk,
                    'waktu_keluar' => $waktu_masuk->copy()->addHours(8),
                    'latitude_masuk' => -6.200000,
                    'longitude_masuk' => 106.816666,
                    'latitude_keluar' => -6.200000,
                    'longitude_keluar' => 106.816666,
                    'status' => 'hadir',
                ]);
            }
        }
    }
}
