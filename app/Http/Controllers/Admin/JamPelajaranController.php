<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JamPelajaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JamPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jamPelajarans = JamPelajaran::orderBy('urutan')->get();
        return view('admin.jam-pelajaran.index', compact('jamPelajarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jam-pelajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'urutan' => 'required|integer|unique:jam_pelajarans,urutan',
            'sesi' => 'required|string|max:255',
            'waktu_mulai' => 'required|date_format:H:i:s,H:i',
            'waktu_selesai' => 'required|date_format:H:i:s,H:i|after:waktu_mulai',
            'tipe' => 'required|in:Pelajaran,Istirahat',
        ]);

        JamPelajaran::create($request->all());

        return redirect()->route('admin.jam-pelajaran.index')
                         ->with('success', 'Jam pelajaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Untuk saat ini tidak digunakan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jamPelajaran = JamPelajaran::findOrFail($id);
        return view('admin.jam-pelajaran.edit', compact('jamPelajaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jamPelajaran = JamPelajaran::findOrFail($id);

        $request->validate([
            'urutan' => [
                'required',
                'integer',
                Rule::unique('jam_pelajarans')->ignore($jamPelajaran->id),
            ],
            'sesi' => 'required|string|max:255',
            'waktu_mulai' => 'required|date_format:H:i:s,H:i',
            'waktu_selesai' => 'required|date_format:H:i:s,H:i|after:waktu_mulai',
            'tipe' => 'required|in:Pelajaran,Istirahat',
        ]);

        $jamPelajaran->update($request->all());

        return redirect()->route('admin.jam-pelajaran.index')
                         ->with('success', 'Jam pelajaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jamPelajaran = JamPelajaran::findOrFail($id);
        $jamPelajaran->delete();

        return redirect()->route('admin.jam-pelajaran.index')
                         ->with('success', 'Jam pelajaran berhasil dihapus.');
    }
}
