<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materis = Materi::where('guru_id', Auth::guard('guru')->id())
            ->with(['mapel', 'kelas', 'tahunAjaran']) // Menambahkan relasi kelas
            ->latest()
            ->get();

        return view('guru.materi.index', compact('materis'));
    }

    public function create()
    {
        $mapels = Mapel::where('is_active', 1)->get();
        $tahunAjarans = TahunAjaran::where('is_active', 1)->get();
        $kelas = Kelas::where('is_active', 1)->get(); // Mengambil data kelas

        return view('guru.materi.create', compact('mapels', 'tahunAjarans', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,zip,rar|max:10240',
            'mapel_id' => 'required|exists:mapels,id',
            'kelas_id' => 'required|exists:kelas,id', // Validasi untuk kelas_id
            'semester' => 'required|in:Ganjil,Genap',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
        ]);

        $filePath = $request->file('file')->store('public/materi');
        $dbFilePath = str_replace('public/', '', $filePath);

        Materi::create([
            'guru_id' => Auth::guard('guru')->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $dbFilePath,
            'mapel_id' => $request->mapel_id,
            'kelas_id' => $request->kelas_id, // Menyimpan kelas_id
            'semester' => $request->semester,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
        ]);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Materi $materi)
    {
        if ($materi->guru_id !== Auth::guard('guru')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $mapels = Mapel::where('is_active', 1)->get();
        $tahunAjarans = TahunAjaran::where('is_active', 1)->get();
        $kelas = Kelas::where('is_active', 1)->get(); // Mengambil data kelas

        return view('guru.materi.edit', compact('materi', 'mapels', 'tahunAjarans', 'kelas'));
    }

    public function update(Request $request, Materi $materi)
    {
        if ($materi->guru_id !== Auth::guard('guru')->id()) {
            abort(403);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,rar|max:10240',
            'mapel_id' => 'required|exists:mapels,id',
            'kelas_id' => 'required|exists:kelas,id', // Validasi untuk kelas_id
            'semester' => 'required|in:Ganjil,Genap',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
        ]);

        $materi->judul = $request->input('judul');
        $materi->deskripsi = $request->input('deskripsi');
        $materi->mapel_id = $request->input('mapel_id');
        $materi->kelas_id = $request->input('kelas_id'); // Memperbarui kelas_id
        $materi->semester = $request->input('semester');
        $materi->tahun_ajaran_id = $request->input('tahun_ajaran_id');
        $materi->is_active = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('file')) {
            if ($materi->file_path) {
                Storage::delete('public/' . $materi->file_path);
            }
            $filePath = $request->file('file')->store('public/materi');
            $materi->file_path = str_replace('public/', '', $filePath);
        }

        $materi->save();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->guru_id !== Auth::guard('guru')->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($materi->file_path) {
            Storage::delete('public/' . $materi->file_path);
        }

        $materi->delete();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dihapus.');
    }
    
    public function updateStatus(Request $request, Materi $materi)
    {
        if ($materi->guru_id !== Auth::guard('guru')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'is_active' => 'required|boolean',
        ]);

        $materi->is_active = $request->is_active;
        $materi->save();

        return response()->json(['success' => true, 'message' => 'Status materi berhasil diperbarui.']);
    }
}
