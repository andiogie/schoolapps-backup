<?php

namespace App\Models;

use App\Models\Traits\Auditable;
use App\Models\Traits\Blamable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pendaftaran extends Model
{
    use HasFactory, Blamable, Auditable;

    protected $table = 'pendaftarans';

    protected $fillable = [
        'no_pendaftaran',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'no_hp',
        'email',
        'nomor_kk',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'no_hp_ortu',
        'asal_sekolah',
        'jurusan',
        'ijazah_path',
        'status',
        'catatan',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function jurusanRelasi()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan', 'nama_jurusan');
    }

    /**
     * Definisikan relasi one-to-one ke model Siswa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, 'pendaftaran_id', 'id');
    }
}
