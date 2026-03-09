<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfilSekolah;
use App\Models\Guru; // Import the Guru model

class ProfilSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find the principal from the gurus table
        $kepalaSekolah = Guru::where('is_kepala_sekolah', 1)->first();

        ProfilSekolah::create([
            'nama_sekolah' => 'SMA Swasta Hebat',
            'alamat' => 'Jl. Pendidikan No. 123, Kota Ilmu, Indonesia',
            'email' => 'info@smaswastahebat.sch.id',
            'telepon' => '021-987-6543',
            'website' => 'www.smaswastahebat.sch.id',
            // Using a placeholder URL from Freepik
            'logo_path' => 'https://img.freepik.com/free-vector/high-school-logo-design-template_7492-31.jpg',
            'visi' => 'Menjadi institusi pendidikan yang unggul dalam mencetak generasi berkarakter, cerdas, dan kompetitif secara global.',
            'misi' => '1. Menyelenggarakan pendidikan berkualitas dengan kurikulum yang adaptif.\n2. Mengembangkan potensi siswa secara holistik.\n3. Membangun lingkungan belajar yang inspiratif dan suportif.',
            // FIXED: Use the correct property 'nama' instead of 'nama_guru'
            'nama_kepala_sekolah' => $kepalaSekolah ? $kepalaSekolah->nama : 'Kepala Sekolah Belum Ditentukan',
        ]);
    }
}
