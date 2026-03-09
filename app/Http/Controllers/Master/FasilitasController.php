<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::latest()->paginate(10);
        return view('admin.master.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.master.fasilitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi_fasilitas' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('fasilitas', 'public');
        }

        $fasilitas = Fasilitas::create([
            'nama_fasilitas' => $request->nama_fasilitas,
            'deskripsi_fasilitas' => $request->deskripsi_fasilitas,
            'image' => $imagePath,
            'is_active' => $request->is_active,
        ]);

        Log::info('Fasilitas baru telah ditambahkan', ['fasilitas_id' => $fasilitas->id, 'nama' => $fasilitas->nama_fasilitas]);

        return redirect()->route('admin.master.fasilitas.index')
                         ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function show(Fasilitas $fasilita)
    {
        return redirect()->route('admin.master.fasilitas.edit', $fasilita->id);
    }

    public function edit(Fasilitas $fasilita)
    {
        return view('admin.master.fasilitas.edit', ['fasilitas' => $fasilita]);
    }

    public function update(Request $request, Fasilitas $fasilita)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi_fasilitas' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($fasilita->image) {
                Storage::disk('public')->delete($fasilita->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('fasilitas', 'public');
        }

        $fasilita->update($data);

        Log::info('Fasilitas telah diperbarui', ['fasilitas_id' => $fasilita->id, 'nama' => $fasilita->nama_fasilitas]);

        return redirect()->route('admin.master.fasilitas.index')
                         ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        return redirect()->route('admin.master.fasilitas.index')
                         ->with('warning', 'Fungsi hapus tidak diaktifkan.');
    }

    // === API METHODS ===

    public function apiIndex()
    {
        $fasilitas = Fasilitas::where('is_active', 1)->get()->map(function($item) {
            $item->image_url = $item->image ? Storage::disk('public')->url($item->image) : null;
            return $item;
        });
        return response()->json($fasilitas);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi_fasilitas' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('fasilitas', 'public');
        }

        $fasilitas = Fasilitas::create([
            'nama_fasilitas' => $request->nama_fasilitas,
            'deskripsi_fasilitas' => $request->deskripsi_fasilitas,
            'image' => $imagePath,
            'is_active' => 1,
        ]);
        
        Log::info('Fasilitas baru telah ditambahkan via API', ['fasilitas_id' => $fasilitas->id, 'nama' => $fasilitas->nama_fasilitas]);

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil ditambahkan.',
            'data' => $fasilitas
        ], 201);
    }
}
