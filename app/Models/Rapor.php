<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Rapor extends Model
{
    use HasFactory;

    /**
     * Ambang batas nilai rata-rata minimum untuk kelulusan atau kenaikan kelas.
     */
    const MINIMUM_PASSING_GRADE = 75;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'siswa_id',
        'wali_kelas_id',
        'tahun_ajaran_id',
        'semester',
        'status',
        'catatan_wali_kelas',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['nilai_rata_rata', 'status_akademik'];

    /**
     * Relasi ke model Siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    /**
     * Relasi ke model Guru (sebagai wali kelas).
     */
    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id');
    }

    /**
     * Relasi ke model TahunAjaran.
     */
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    /**
     * Relasi ke model RaporDetail.
     */
    public function details()
    {
        return $this->hasMany(RaporDetail::class);
    }

    /**
     * ACCESOR: Menghitung nilai rata-rata dari semua detail rapor.
     */
    protected function nilaiRataRata(): Attribute
    {
        return Attribute::make(
            get: function () {
                $validDetails = $this->details->whereNotNull('nilai');
                if ($validDetails->isEmpty()) {
                    return 0;
                }
                return round($validDetails->avg('nilai'), 2);
            }
        );
    }

    /**
     * ACCESOR: Menentukan status akademik akhir siswa (Lulus, Naik Kelas, dll.).
     * Ini adalah logika utama yang Anda usulkan.
     */
    protected function statusAkademik(): Attribute
    {
        return Attribute::make(
            get: function () {
                // Pastikan relasi siswa dan kelas ada
                if (!$this->siswa || !$this->siswa->kelas) {
                    return 'Informasi Kelas Tidak Tersedia';
                }

                $isPassing = $this->nilai_rata_rata >= self::MINIMUM_PASSING_GRADE;
                $currentClass = $this->siswa->kelas;
                $classNameParts = explode(' ', $currentClass->nama_kelas, 2);
                $currentGrade = strtoupper($classNameParts[0]);

                // --- Logika untuk Kelas XII ---
                if ($currentGrade === 'XII') {
                    return $isPassing ? 'LULUS' : 'TIDAK LULUS';
                }

                // --- Logika untuk Kelas X dan XI ---
                if (in_array($currentGrade, ['X', 'XI'])) {
                    if (!$isPassing) {
                        return 'TIDAK NAIK KELAS';
                    }

                    // Tentukan tingkat kelas berikutnya
                    $nextGradeMap = ['X' => 'XI', 'XI' => 'XII'];
                    $nextGrade = $nextGradeMap[$currentGrade] ?? null;

                    if (!$nextGrade) {
                        return 'Naik Kelas'; // Fallback jika mapping tidak ditemukan
                    }

                    // Cari nama kelas berikutnya (contoh: "X TKJ 1" -> "XI TKJ 1")
                    $classIdentifier = $classNameParts[1] ?? ''; // "TKJ 1"
                    $nextClassName = $nextGrade . ' ' . $classIdentifier;

                    // Cek apakah kelas berikutnya ada di database
                    $nextClassExists = Kelas::where('nama_kelas', $nextClassName)
                                          ->where('jurusan_id', $currentClass->jurusan_id)
                                          ->exists();

                    if ($nextClassExists) {
                        return 'Naik ke Kelas: ' . $nextClassName;
                    } else {
                        // Fallback jika kelas spesifik tidak ditemukan, tapi siswa tetap naik
                        return 'Naik Kelas';
                    }
                }
                
                // Fallback untuk tingkat kelas yang tidak terdefinisi (misal: XIII atau lainnya)
                return $isPassing ? 'Memenuhi Syarat' : 'Tidak Memenuhi Syarat';
            }
        );
    }
}
