<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiGuru extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'waktu_masuk',
        'waktu_keluar',
        'lokasi_masuk',
        'lokasi_keluar',
    ];

    protected $casts = [
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
