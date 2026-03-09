<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data siswa yang sedang login
        $siswa = Auth::guard('siswa')->user();

        // 2. Ambil data relasi yang dibutuhkan secara efisien (Eager Loading)
        // Ini akan mengambil siswa, lalu memuat data kelasnya,
        // lalu data jurusan dari kelas itu, dan data wali kelas (guru) dari kelas itu.
        $siswa->load('kelas.jurusan', 'kelas.waliKelas');

        // 3. Kirim data lengkap ke view
        return view('siswa.dashboard', compact('siswa'));
    }
}
