<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Rapor;
use App\Models\RaporDetail;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use App\Models\ProfilSekolah; // BARU: Impor model ProfilSekolah
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RaporController extends Controller
{
    public function index()
    {
        $guru = Auth::guard('guru')->user();
        
        if (!$guru->is_wali_kelas || !$guru->kelas) {
            return redirect()->route('guru.dashboard')->with('error', 'Anda bukan wali kelas atau tidak memiliki kelas.');
        }

        $siswas = $guru->kelas->siswas ?? collect();

        return view('guru.rapor.index', compact('siswas'));
    }

    public function show(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->firstOrFail();
        $profilSekolah = ProfilSekolah::first(); // BARU: Ambil data profil sekolah

        $rapor = Rapor::with(['details.mapel', 'siswa', 'waliKelas', 'tahunAjaran'])
                      ->where('siswa_id', $siswa->id)
                      ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
                      ->first();

        if (!$rapor) {
            return redirect()->route('guru.rapor.edit', $siswa->id)
                             ->with('info', 'Rapor untuk siswa ini belum diisi. Silakan isi terlebih dahulu.');
        }

        // BARU: Kirim data profil ke view
        return view('guru.rapor.show', compact('rapor', 'profilSekolah'));
    }

    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->firstOrFail();

        $rapor = Rapor::firstOrCreate(
            [
                'siswa_id' => $siswa->id,
                'tahun_ajaran_id' => $tahunAjaranAktif->id
            ],
            [
                'wali_kelas_id' => Auth::guard('guru')->id(),
                'catatan_wali_kelas' => '' 
            ]
        );

        $raporDetails = $rapor->details;
        $mapels = Mapel::where('is_active', true)->get();

        return view('guru.rapor.edit', compact('siswa', 'rapor', 'raporDetails', 'mapels'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'catatan_wali_kelas' => 'nullable|string',
            'details' => 'required|array',
            'details.*.nilai' => 'nullable|numeric|min:0|max:100',
            'details.*.deskripsi' => 'nullable|string',
        ]);

        $siswa = Siswa::findOrFail($id);
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->firstOrFail();

        DB::transaction(function () use ($request, $siswa, $tahunAjaranAktif) {
            $rapor = Rapor::firstOrCreate(
                [
                    'siswa_id' => $siswa->id,
                    'tahun_ajaran_id' => $tahunAjaranAktif->id
                ]
            );

            $rapor->update([
                'wali_kelas_id' => Auth::guard('guru')->id(),
                'catatan_wali_kelas' => $request->catatan_wali_kelas,
            ]);

            foreach ($request->details as $mapel_id => $data) {
                if (!empty($data['nilai']) || !empty($data['deskripsi'])) {
                    RaporDetail::updateOrCreate(
                        [
                            'rapor_id' => $rapor->id,
                            'mapel_id' => $mapel_id,
                        ],
                        [
                            'nilai' => $data['nilai'],
                            'deskripsi' => $data['deskripsi'],
                        ]
                    );
                }
            }
        });

        return redirect()->route('guru.rapor.index')->with('success', 'Rapor untuk siswa ' . $siswa->nama . ' berhasil diperbarui.');
    }
    
    public function create()
    {
        return redirect()->route('guru.rapor.index');
    }

    public function store(Request $request)
    {
        return redirect()->route('guru.rapor.index');
    }

    public function generatePDF(Rapor $rapor)
    {
        $rapor->load(['details.mapel', 'siswa.kelas', 'waliKelas', 'tahunAjaran']);
        $profilSekolah = ProfilSekolah::first(); // BARU: Ambil data profil sekolah
        
        // BARU: Kirim data profil ke view
        return view('guru.rapor.pdf', compact('rapor', 'profilSekolah'));
    }

    /**
     * BARU: Menampilkan rapor untuk siswa yang sedang login.
     */
    public function showRaporSiswa()
    {
        $siswa = Auth::guard('siswa')->user();
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();
        $profilSekolah = ProfilSekolah::first(); // BARU: Ambil data profil sekolah

        if (!$tahunAjaranAktif) {
            // BARU: Tetap kirim data profil, meskipun rapor tidak ada
            return view('siswa.rapor.show', compact('profilSekolah'))->with('error', 'Saat ini tidak ada data rapor yang tersedia.');
        }

        $rapor = Rapor::with(['details.mapel', 'siswa.kelas', 'waliKelas', 'tahunAjaran'])
                      ->where('siswa_id', $siswa->id)
                      ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
                      ->first();

        // BARU: Kirim data profil ke view
        return view('siswa.rapor.show', compact('rapor', 'profilSekolah'));
    }

    /**
     * BARU: Mengizinkan siswa mengunduh rapor mereka sendiri dalam format PDF.
     */
    public function downloadRaporSiswa()
    {
        $siswa = Auth::guard('siswa')->user();
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAjaranAktif) {
            abort(404, 'Rapor tidak ditemukan.');
        }

        $rapor = Rapor::where('siswa_id', $siswa->id)
                      ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
                      ->firstOrFail();

        return $this->generatePDF($rapor);
    }
}
