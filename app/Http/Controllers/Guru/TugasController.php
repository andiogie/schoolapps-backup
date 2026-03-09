<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Auth::guard('guru')->user();
        $tugas = Tugas::where('guru_id', $guru->id)->with(['kelas', 'mapel'])->latest()->get();

        return view('guru.tugas.index', compact('tugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        $mapel = Mapel::all();

        return view('guru.tugas.create', compact('kelas', 'mapel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'batas_waktu' => 'required|date',
        ]);

        Tugas::create([
            'guru_id' => Auth::guard('guru')->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'batas_waktu' => $request->batas_waktu,
            'tipe' => 'umum', // Default value
        ]);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tugas $tuga)
    {
        $tuga->load(['pengumpulanTugas.siswa']);

        return view('guru.tugas.show', compact('tuga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tugas $tuga)
    {
        $kelas = Kelas::all();
        $mapel = Mapel::all();

        return view('guru.tugas.edit', compact('tuga', 'kelas', 'mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tugas $tuga)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'batas_waktu' => 'required|date',
        ]);

        $tuga->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'batas_waktu' => $request->batas_waktu,
        ]);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil diperbarui.');
    }
}
