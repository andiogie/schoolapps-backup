<?php

namespace Database\Seeders;

use App\Models\Mapel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan MapelFactory untuk membuat 15 data mapel.
        // Factory akan otomatis mengisi nama mapel secara cerdas.
        Mapel::factory(15)->create();
    }
}
