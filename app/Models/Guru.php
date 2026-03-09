<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'nip',
        'email',
        'mapel_id',
        'password',
        'is_active',
        'is_kepala_sekolah',
        'is_wali_kelas',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_kepala_sekolah' => 'boolean',
        'is_wali_kelas' => 'boolean',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    /**
     * Mendefinisikan relasi one-to-one ke model Kelas.
     * Relasi ini menunjukkan kelas mana yang diampu oleh guru ini sebagai wali kelas.
     */
    public function kelasWali()
    {
        return $this->hasOne(Kelas::class, 'wali_kelas_id');
    }
}
