<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan halaman Tentang Kami.
     */
    public function tentangKami()
    {
        return view('pages.tentang-kami');
    }

    /**
     * Menampilkan halaman Visi & Misi.
     */
    public function visiMisi()
    {
        $profil = ProfilSekolah::first();
        return view('landing.visi-misi', compact('profil'));
    }

    /**
     * Menampilkan halaman Jurusan.
     */
    public function jurusan()
    {
        return view('landing.jurusan');
    }

    /**
     * Menampilkan halaman Fasilitas.
     */
    public function fasilitas()
    {
        return view('landing.fasilitas');
    }

    /**
     * Menampilkan halaman Prestasi.
     */
    public function prestasi()
    {
        return view('landing.prestasi');
    }

    /**
     * Menampilkan halaman Mengapa Kami.
     */
    public function mengapaKami()
    {
        return view('landing.mengapa-kami');
    }

    /**
     * Menampilkan halaman Lisensi.
     */
    public function lisensi()
    {
        return view('pages.lisensi');
    }
}
