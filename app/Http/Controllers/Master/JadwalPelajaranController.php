<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class JadwalPelajaranController extends Controller
{
    // =================================================================================
    // =========== METHOD UNTUK ADMIN PANEL (MENGEMBALIKAN VIEW) =======================
    // =================================================================================

    public function index()
    {
        $jadwals = JadwalPelajaran::with(['tahunAjaran', 'kelas', 'mapel', 'guru'])->orderBy('id', 'asc')->paginate(15);
        return view('admin.master.jadwal-pelajaran.index', compact('jadwals'));
    }

    public function create()
    {
        $tahunAjarans = TahunAjaran::where('is_active', 1)->get();
        $kelas = Kelas::where('is_active', 1)->get();
        $mapels = Mapel::where('is_active', 1)->get();
        $gurus = Guru::where('is_active', 1)->get();
        return view('admin.master.jadwal-pelajaran.create', compact('tahunAjarans', 'kelas', 'mapels', 'gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'guru_id' => 'required|exists:gurus,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);
        JadwalPelajaran::create($request->all());
        return redirect()->route('admin.master.jadwal-pelajaran.index')->with('success', 'Jadwal pelajaran berhasil ditambahkan.');
    }

    public function edit(JadwalPelajaran $jadwalPelajaran)
    {
        $tahunAjarans = TahunAjaran::where('is_active', 1)->get();
        $kelas = Kelas::where('is_active', 1)->get();
        $mapels = Mapel::where('is_active', 1)->get();
        $gurus = Guru::where('is_active', 1)->get();
        return view('admin.master.jadwal-pelajaran.edit', compact('jadwalPelajaran', 'tahunAjarans', 'kelas', 'mapels', 'gurus'));
    }

    public function update(Request $request, JadwalPelajaran $jadwalPelajaran)
    {
        $request->validate([
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'guru_id' => 'required|exists:gurus,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);
        $jadwalPelajaran->update($request->all());
        return redirect()->route('admin.master.jadwal-pelajaran.index')->with('success', 'Jadwal pelajaran berhasil diperbarui.');
    }

    public function destroy(JadwalPelajaran $jadwalPelajaran)
    {
        $jadwalPelajaran->delete();
        return redirect()->route('admin.master.jadwal-pelajaran.index')->with('success', 'Jadwal pelajaran berhasil dihapus.');
    }

    // =================================================================================
    // ================== METHOD UNTUK API (MENGEMBALIKAN JSON) ========================
    // =================================================================================

    public function apiIndex(): JsonResponse
    {
        $jadwals = JadwalPelajaran::with(['tahunAjaran', 'kelas', 'mapel', 'guru'])->orderBy('id', 'asc')->paginate(15);
        return response()->json($jadwals);
    }

    public function apiStore(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'kelas_id'        => 'required|exists:kelas,id',
            'mapel_id'        => 'required|exists:mapels,id',
            'guru_id'         => 'required|exists:gurus,id',
            'hari'            => 'required|string',
            'jam_mulai'       => 'required|date_format:H:i',
            'jam_selesai'     => 'required|date_format:H:i|after:jam_mulai',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jadwal = JadwalPelajaran::create($request->all());

        return response()->json(['message' => 'Jadwal pelajaran berhasil ditambahkan.', 'data' => $jadwal->load(['tahunAjaran', 'kelas', 'mapel', 'guru'])], 201);
    }

    public function apiUpdate(Request $request, $id): JsonResponse
    {
        $jadwal = JadwalPelajaran::find($id);
        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal pelajaran tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'tahun_ajaran_id' => 'sometimes|required|exists:tahun_ajarans,id',
            'kelas_id'        => 'sometimes|required|exists:kelas,id',
            'mapel_id'        => 'sometimes|required|exists:mapels,id',
            'guru_id'         => 'sometimes|required|exists:gurus,id',
            'hari'            => 'sometimes|required|string',
            'jam_mulai'       => 'sometimes|required|date_format:H:i',
            'jam_selesai'     => 'sometimes|required|date_format:H:i|after:jam_mulai',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jadwal->update($request->all());

        return response()->json(['message' => 'Jadwal pelajaran berhasil diperbarui.', 'data' => $jadwal->load(['tahunAjaran', 'kelas', 'mapel', 'guru'])]);
    }

    public function apiDestroy($id): JsonResponse
    {
        $jadwal = JadwalPelajaran::find($id);
        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal pelajaran tidak ditemukan.'], 404);
        }

        $jadwal->delete();

        return response()->json(['message' => 'Jadwal pelajaran berhasil dihapus.']);
    }
}
