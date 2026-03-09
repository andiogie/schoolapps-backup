<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use App\Models\Admin;
use App\Models\Jurusan;
use Faker\Factory as Faker;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $jurusanNames = Jurusan::pluck('nama_jurusan')->toArray();
        $admin = Admin::first();

        if (!$admin || empty($jurusanNames)) {
            $this->command->warn('Tidak dapat menjalankan PendaftaranSeeder. Pastikan ada data di tabel Admin dan Jurusan.');
            return;
        }

        $statuses = ['pending', 'verified', 'rejected'];
        $payment_statuses = ['belum_bayar', 'menunggu_verifikasi', 'lunas', 'ditolak'];

        for ($i = 0; $i < 50; $i++) {
            Pendaftaran::create([
                'no_pendaftaran' => 'PPDB-' . now()->year . '-' . str_pad($i + 1, 5, '0', STR_PAD_LEFT),
                
                'nama_lengkap' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date($format = 'Y-m-d', $max = '-15 years'),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
                'alamat' => $faker->address,
                // DIPERBAIKI: Menggunakan format numerik sederhana untuk nomor HP
                'no_hp' => $faker->numerify('08##########'),
                'email' => $faker->unique()->safeEmail,

                'nomor_kk' => $faker->unique()->numerify('################'),
                'nama_ayah' => $faker->name('male'),
                'pekerjaan_ayah' => $faker->jobTitle,
                'nama_ibu' => $faker->name('female'),
                'pekerjaan_ibu' => $faker->jobTitle,
                // DIPERBAIKI: Menggunakan format numerik sederhana untuk nomor HP
                'no_hp_ortu' => $faker->numerify('08##########'),

                'asal_sekolah' => 'SMPN ' . $faker->numberBetween(1, 20) . ' ' . $faker->city,
                'jurusan' => $faker->randomElement($jurusanNames),
                'ijazah_path' => 'documents/ijazah_placeholder.pdf',

                'total_biaya' => 500000.00,
                'total_bayar' => $faker->randomElement([0, 250000, 500000]),
                'status_pembayaran' => $faker->randomElement($payment_statuses),
                'bukti_pembayaran_path' => 'documents/bukti_placeholder.jpg',

                'status' => $faker->randomElement($statuses),
                'catatan' => $faker->optional()->sentence,

                'created_by' => null,
                'updated_by' => $admin->id,
            ]);
        }
    }
}
