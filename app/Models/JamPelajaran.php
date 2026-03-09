<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamPelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'urutan',
        'sesi',
        'waktu_mulai',
        'waktu_selesai',
        'tipe',
    ];
}
