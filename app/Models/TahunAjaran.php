<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_ajaran',
        'semester',
        'is_active',
    ];

    /**
     * Get the kalender sekolah for the tahun ajaran.
     */
    public function kalenderSekolah(): HasMany
    {
        return $this->hasMany(KalenderSekolah::class);
    }
}
