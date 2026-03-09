<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_mapel',
        'nama_mapel',
        'is_active',
    ];

    /**
     * Mendefinisikan relasi one-to-many ke model Guru.
     * Satu mata pelajaran bisa diajar oleh banyak guru.
     */
    public function guru()
    {
        // Kunci asing yang benar adalah 'mapel_id' sesuai dengan yang ada di tabel 'gurus'
        return $this->hasMany(Guru::class, 'mapel_id');
    }
}
