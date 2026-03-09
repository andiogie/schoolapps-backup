<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KalenderSekolah extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kalender_sekolah';

    protected $fillable = [
        'tahun_ajaran_id',
        'nama_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
        'is_active',
    ];

    /**
     * Get the tahun ajaran that owns the kalender sekolah.
     */
    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
