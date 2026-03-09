<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IzinGuru;

class IzinController extends Controller
{
    /**
     * Menampilkan halaman daftar pengajuan izin dari semua guru.
     */
    public function index()
    {
        // Ambil semua data izin guru, diurutkan dari yang terbaru
        // dan eager load relasi 'guru' untuk menampilkan nama.
        $daftarIzin = IzinGuru::with('guru')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('kepala-sekolah.izin.index', compact('daftarIzin'));
    }

    /**
     * Menyetujui pengajuan izin.
     */
    public function approve($id)
    {
        $izin = IzinGuru::findOrFail($id);
        $izin->status = 'Disetujui';
        $izin->save();

        return redirect()->route('kepala-sekolah.izin.index')->with('success', 'Pengajuan izin telah disetujui.');
    }

    /**
     * Menolak pengajuan izin.
     */
    public function reject($id)
    {
        $izin = IzinGuru::findOrFail($id);
        $izin->status = 'Ditolak';
        $izin->save();

        return redirect()->route('kepala-sekolah.izin.index')->with('success', 'Pengajuan izin telah ditolak.');
    }
}
