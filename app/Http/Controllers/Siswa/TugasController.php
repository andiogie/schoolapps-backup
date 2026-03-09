<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Auth::guard('siswa')->user();
        $tugas = Tugas::where('kelas_id', $siswa->kelas_id)->latest()->get();

        return view('siswa.tugas.index', compact('tugas'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Tugas $tugas)
    {
        $siswa = Auth::guard('siswa')->user();
        $pengumpulan = PengumpulanTugas::where('tugas_id', $tugas->id)
                                        ->where('siswa_id', $siswa->id)
                                        ->first();

        return view('siswa.tugas.show', compact('tugas', 'pengumpulan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Tugas $tugas)
    {
        $request->validate([
            'file_tugas' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        $siswa = Auth::guard('siswa')->user();

        // Cek apakah sudah pernah mengumpulkan
        $existingPengumpulan = PengumpulanTugas::where('tugas_id', $tugas->id)
                                               ->where('siswa_id', $siswa->id)
                                               ->first();

        if ($existingPengumpulan) {
            // Hapus file lama jika ada
            if ($existingPengumpulan->file_path) {
                Storage::disk('public')->delete($existingPengumpulan->file_path);
            }
            $existingPengumpulan->delete();
        }

        // Simpan file baru
        $filePath = $request->file('file_tugas')->store('pengumpulan_tugas', 'public');

        // Buat entri baru
        PengumpulanTugas::create([
            'tugas_id' => $tugas->id,
            'siswa_id' => $siswa->id,
            'tanggal_pengumpulan' => now(),
            'file_path' => $filePath,
            'nilai' => null, // Nilai akan diisi oleh guru
        ]);

        return redirect()->route('siswa.tugas.show', $tugas->id)->with('success', 'Tugas berhasil dikumpulkan.');
    }
}
