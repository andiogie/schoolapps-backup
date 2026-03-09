<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{
    // Bagian untuk Admin Panel
    public function index(Request $request)
    {
        $query = Kelas::with(['jurusan', 'waliKelas'])->orderBy('id', 'asc');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama_kelas', 'like', '%' . $search . '%');
        }
        $kelass = $query->paginate(15);
        return view('admin.master.kelas.index', compact('kelass'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        $gurus = Guru::all();
        return view('admin.master.kelas.create', compact('jurusans', 'gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
            'jurusan_id' => 'required|exists:jurusans,id',
            'wali_kelas_id' => 'nullable|exists:gurus,id',
        ]);

        Kelas::create($request->all());

        return redirect()->route('admin.master.kelas.index')
                        ->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kela)
    {
        $jurusans = Jurusan::all();
        $gurus = Guru::all();
        $kelas = $kela;
        return view('admin.master.kelas.edit', compact('kelas', 'jurusans', 'gurus'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => ['required', 'string', 'max:255', Rule::unique('kelas')->ignore($kela->id)],
            'jurusan_id' => 'required|exists:jurusans,id',
            'wali_kelas_id' => 'nullable|exists:gurus,id',
        ]);
        
        $kelas = $kela;
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'jurusan_id' => $request->jurusan_id,
            'wali_kelas_id' => $request->wali_kelas_id,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.master.kelas.index')
                        ->with('success', 'Kelas berhasil diperbarui.');
    }

    // Bagian untuk API
    public function apiIndex(Request $request): JsonResponse
    {
        $query = Kelas::with(['jurusan', 'waliKelas'])->orderBy('id', 'asc');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama_kelas', 'like', '%' . $search . '%');
        }
        $kelases = $query->paginate(15);
        return response()->json($kelases);
    }

    public function apiStore(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
            'jurusan_id' => 'required|exists:jurusans,id',
            'wali_kelas_id' => 'nullable|exists:gurus,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kelas = Kelas::create($request->all());
        $kelas->load(['jurusan', 'waliKelas']);

        return response()->json(['message' => 'Kelas berhasil ditambahkan.', 'data' => $kelas], 201);
    }

    public function apiUpdate(Request $request, $id): JsonResponse
    {
        $kelas = Kelas::find($id);
        if (!$kelas) {
            return response()->json(['message' => 'Kelas tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_kelas' => ['required', 'string', 'max:255', Rule::unique('kelas')->ignore($id)],
            'jurusan_id' => 'required|exists:jurusans,id',
            'wali_kelas_id' => 'nullable|exists:gurus,id',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kelas->update($request->only(['nama_kelas', 'jurusan_id', 'wali_kelas_id', 'is_active']));
        $kelas->load(['jurusan', 'waliKelas']);

        return response()->json(['message' => 'Kelas berhasil diperbarui.', 'data' => $kelas]);
    }

    public function destroy($id): JsonResponse
    {
        $kelas = Kelas::find($id);
        if (!$kelas) {
            return response()->json(['message' => 'Kelas tidak ditemukan.'], 404);
        }

        $kelas->delete();

        return response()->json(['message' => 'Kelas berhasil dihapus.'], 200);
    }
}
