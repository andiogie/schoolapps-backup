<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JurusanController extends Controller
{
    // Bagian untuk Admin Panel
    public function index(Request $request)
    {
        $query = Jurusan::query()->orderBy('id', 'asc');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama_jurusan', 'like', '%' . $search . '%');
        }
        $jurusans = $query->paginate(10);
        return view('admin.master.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('admin.master.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255|unique:jurusans,nama_jurusan',
        ]);

        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.master.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('admin.master.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama_jurusan' => ['required', 'string', 'max:255', Rule::unique('jurusans')->ignore($jurusan->id)],
        ]);

        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.master.jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }
    
    // Bagian untuk API
    public function apiIndex(): JsonResponse
    {
        return response()->json(Jurusan::all());
    }

    public function apiStore(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nama_jurusan' => 'required|string|max:255|unique:jurusans,nama_jurusan',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jurusan = Jurusan::create($request->all());

        return response()->json(['message' => 'Jurusan berhasil ditambahkan.', 'data' => $jurusan], 201);
    }

    public function apiUpdate(Request $request, $id): JsonResponse
    {
        $jurusan = Jurusan::find($id);
        if (!$jurusan) {
            return response()->json(['message' => 'Jurusan tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_jurusan' => ['required', 'string', 'max:255', Rule::unique('jurusans')->ignore($id)],
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jurusan->update($request->only(['nama_jurusan', 'is_active']));

        return response()->json(['message' => 'Jurusan berhasil diperbarui.', 'data' => $jurusan]);
    }

    public function destroy($id): JsonResponse
    {
        $jurusan = Jurusan::find($id);
        if (!$jurusan) {
            return response()->json(['message' => 'Jurusan tidak ditemukan.'], 404);
        }

        $jurusan->delete();

        return response()->json(['message' => 'Jurusan berhasil dihapus.'], 200);
    }
}
