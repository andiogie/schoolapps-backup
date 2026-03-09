<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Jurusan;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan data statistik.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Menghitung total data
        $totalPendaftar = Pendaftaran::count();
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalJurusan = Jurusan::count();

        // Menghitung pendaftar baru hari ini
        $pendaftarHariIni = Pendaftaran::whereDate('created_at', Carbon::today())->count();

        // Mengambil 5 pendaftar terbaru dengan relasi jurusan
        $pendaftarTerbaru = Pendaftaran::with('jurusanRelasi')->orderBy('created_at', 'desc')->take(5)->get();

        // Mengirim data ke view
        return view('admin.dashboard', compact(
            'totalPendaftar',
            'pendaftarHariIni',
            'totalSiswa',
            'totalGuru',
            'totalJurusan', 
            'pendaftarTerbaru'
        ));
    }
}
