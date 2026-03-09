<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jurusans')->insert([
            ['nama_jurusan' => 'Rekayasa Perangkat Lunak', 'is_active' => true],
            ['nama_jurusan' => 'Teknik Komputer dan Jaringan', 'is_active' => true],
            ['nama_jurusan' => 'Multimedia', 'is_active' => true],
        ]);
    }
}
