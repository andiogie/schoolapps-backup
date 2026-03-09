<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MapelController extends Controller
{
    // =================================================================================
    // =========== METHOD UNTUK ADMIN PANEL (MENGEMBALIKAN VIEW) =======================
    // =================================================================================

    public function index(Request $request)
    {
        $query = Mapel::orderBy('id', 'asc');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_mapel', 'like', '%' . $search . '%')
                  ->orWhere('kode_mapel', 'like', '%' . $search . '%');
            });
        }
        $mapels = $query->paginate(15);
        return view('admin.master.mapel.index', compact('mapels'));
    }

    public function create()
    {
        return view('admin.master.mapel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mapel' => 'required|unique:mapels,kode_mapel|max:10',
            'nama_mapel' => 'required|max:255',
        ]);
        Mapel::create($request->all());
        return redirect()->route('admin.master.mapel.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit(Mapel $mapel)
    {
        return view('admin.master.mapel.edit', compact('mapel'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'kode_mapel' => ['required', 'max:10', Rule::unique('mapels')->ignore($mapel->id)],
            'nama_mapel' => 'required|max:255',
        ]);
        $mapel->update([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.master.mapel.index')->with('success', 'Data mata pelajaran berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return redirect()->route('admin.master.mapel.index')->with('success', 'Data mata pelajaran berhasil dihapus.');
    }

    // ... [Fungsi import dan toggle tetap di sini, tidak diubah]

    // =================================================================================
    // ================== METHOD UNTUK API (MENGEMBALIKAN JSON) ========================
    // =================================================================================

    public function apiIndex(Request $request): JsonResponse
    {
        $query = Mapel::orderBy('id', 'asc');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_mapel', 'like', '%' . $search . '%')
                  ->orWhere('kode_mapel', 'like', '%' . $search . '%');
            });
        }
        $mapels = $query->paginate(15);
        return response()->json($mapels);
    }

    public function apiStore(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'kode_mapel' => 'required|unique:mapels,kode_mapel|max:10',
            'nama_mapel' => 'required|string|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mapel = Mapel::create($request->all());
        return response()->json(['message' => 'Mata pelajaran berhasil ditambahkan.', 'data' => $mapel], 201);
    }

    public function apiUpdate(Request $request, $id): JsonResponse
    {
        $mapel = Mapel::find($id);
        if (!$mapel) {
            return response()->json(['message' => 'Mata pelajaran tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'kode_mapel' => ['sometimes', 'required', 'max:10', Rule::unique('mapels')->ignore($id)],
            'nama_mapel' => 'sometimes|required|string|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mapel->update($request->all());
        return response()->json(['message' => 'Mata pelajaran berhasil diperbarui.', 'data' => $mapel]);
    }

    public function apiDestroy($id): JsonResponse
    {
        $mapel = Mapel::find($id);
        if (!$mapel) {
            return response()->json(['message' => 'Mata pelajaran tidak ditemukan.'], 404);
        }
        
        // Cek relasi sebelum menghapus
        if ($mapel->guru()->exists()) {
            return response()->json(['message' => 'Gagal menghapus. Mata pelajaran ini masih digunakan oleh beberapa guru.'], 409);
        }

        $mapel->delete();
        return response()->json(['message' => 'Mata pelajaran berhasil dihapus.'], 200);
    }
}
