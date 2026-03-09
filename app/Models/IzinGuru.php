<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinGuru extends Model
{
    use HasFactory;

    protected $table = 'izin_gurus';

    protected $fillable = [
        'guru_id',
        'jenis_izin',
        'alasan',
        'tanggal_mulai',
        'tanggal_selesai',
        'file_pendukung',
        'status',
        'approved_by',
    ];

    /**
     * Get the guru that owns the izin.
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    /**
     * Get the user who approved the izin.
     */
    public function approver()
    {
        return $this->belongsTo(Guru::class, 'approved_by');
    }
}
