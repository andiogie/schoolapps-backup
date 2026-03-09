<?php

namespace Database\Factories;

use App\Models\Mapel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GuruFactory extends Factory
{
    // Kebutuhan untuk password default
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nip' => $this->faker->unique()->numerify('##########'), // 10 digit NIP
            'email' => $this->faker->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            
            // Ambil mapel_id secara acak dari Mapel yang ada.
            // Pastikan MapelSeeder dijalankan sebelum GuruSeeder.
            'mapel_id' => Mapel::inRandomOrder()->first()->id ?? null,

            'is_kepala_sekolah' => false,
            'is_wali_kelas' => false,
            'is_active' => true,
            'remember_token' => Str::random(10),
        ];
    }
}
