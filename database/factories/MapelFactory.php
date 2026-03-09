<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MapelFactory extends Factory
{
    public function definition(): array
    {
        $namaMapelList = [
            'Matematika', 'Fisika', 'Kimia', 'Biologi', 'Sejarah Indonesia',
            'Bahasa Indonesia', 'Bahasa Inggris', 'Pendidikan Pancasila', 'Seni Budaya',
            'Pendidikan Jasmani', 'Informatika', 'Ekonomi', 'Geografi', 'Sosiologi',
            'Bahasa Jepang', 'Bahasa Mandarin', 'Akuntansi', 'Administrasi Perkantoran',
            'Pemasaran', 'Teknik Komputer dan Jaringan',
        ];

        $namaMapel = $this->faker->unique()->randomElement($namaMapelList);
        $kodeMapel = strtoupper(Str::slug($namaMapel, '-')); // e.g., 'BAHASA-INDONESIA'

        // Jika kode terlalu panjang, ambil beberapa huruf dari setiap kata
        if (strlen($kodeMapel) > 10) {
            $parts = explode('-', $kodeMapel);
            $kodeMapel = count($parts) > 1 ? ($parts[0][0] . $parts[1][0]) : substr($parts[0], 0, 3);
            $kodeMapel .= '-' . rand(10, 99);
        }

        return [
            // Sesuaikan dengan nama kolom di migrasi
            'nama_mapel' => $namaMapel,
            'kode_mapel' => $this->faker->unique()->numerify($kodeMapel . '-##'),
            'is_active'  => true,
        ];
    }
}
