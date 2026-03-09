<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TahunAjaran;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TahunAjaran::create([
            'tahun_ajaran' => '2023 - 2024',
            'semester' => 'Ganjil',
            'is_active' => false,
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => '2023 - 2024',
            'semester' => 'Genap',
            'is_active' => false,
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => '2024 - 2025',
            'semester' => 'Ganjil',
            'is_active' => false,
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => '2024 - 2025',
            'semester' => 'Genap',
            'is_active' => true,
        ]);
    }
}
