<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    // =================================================================================
    // =========== METHOD UNTUK ADMIN PANEL (MENGEMBALIKAN VIEW) =======================
    // =================================================================================

    public function index(Request $request)
    {
        $query = Siswa::with('kelas', 'jurusan')->orderBy('nama_siswa', 'asc');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_siswa', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%');
            });
        }
        $siswas = $query->paginate(15);
        return view('admin.master.siswa.index', compact('siswas'));
    }

    public function create(Request $request)
    {
        $kelases = Kelas::orderBy('nama_kelas')->get();
        $pendaftars = null;
        $selectedPendaftar = null;

        $pendaftaranId = $request->input('pendaftaran_id', old('pendaftaran_id'));

        if ($request->filled('search')) {
            $search = $request->input('search');
            $pendaftars = Pendaftaran::where('status', 'verified')
                ->where(function ($query) use ($search) {
                    $query->where('nama_lengkap', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%');
                })
                ->whereDoesntHave('siswa')
                ->get();
        }

        if ($pendaftaranId) {
            $selectedPendaftar = Pendaftaran::with('jurusanRelasi')->where('status', 'verified')->findOrFail($pendaftaranId);
        }

        return view('admin.master.siswa.create', compact('kelases', 'pendaftars', 'selectedPendaftar'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'nis'            => 'required|string|max:255|unique:siswas,nis',
            'kelas_id'       => 'required|exists:kelas,id',
            'password'       => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $pendaftar = Pendaftaran::with('jurusanRelasi')->findOrFail($request->pendaftaran_id);

            if (Siswa::where('pendaftaran_id', $pendaftar->id)->exists()) {
                return redirect()->route('admin.pendaftaran.index')->with('error', 'Pendaftar ini sudah terdaftar sebagai siswa.');
            }
            
            $jurusanId = optional($pendaftar->jurusanRelasi)->id;

            if (!$jurusanId) {
                throw new \Exception("Jurusan '{$pendaftar->jurusan}' yang terdaftar pada pendaftar tidak ditemukan di master data jurusan.");
            }

            $siswa = Siswa::create([
                'nama_siswa'    => $pendaftar->nama_lengkap,
                'nis'           => $request->nis,
                'password'      => Hash::make($request->password),
                'kelas_id'      => $request->kelas_id,
                'jurusan_id'    => $jurusanId, 
                'pendaftaran_id' => $pendaftar->id,
                'tanggal_lahir' => $pendaftar->tanggal_lahir,
                'tempat_lahir'  => $pendaftar->tempat_lahir,
                'alamat'        => $pendaftar->alamat,
                'jenis_kelamin' => $pendaftar->jenis_kelamin,
                'agama'         => $pendaftar->agama,
                'no_hp'         => $pendaftar->no_hp,
                'asal_sekolah'  => $pendaftar->asal_sekolah,
            ]);

            DB::commit();

            return redirect()->route('admin.master.siswa.index')->with('success', 'Siswa '. $siswa->nama_siswa .' berhasil dibuat dari pendaftar.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat siswa: ' . $th->getMessage())->withInput();
        }
    }

    public function edit(Siswa $siswa)
    {
        // PERBAIKAN: Mengubah nama variabel dari $kelas menjadi $kelases
        $kelases = Kelas::orderBy('nama_kelas')->get();
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();
        // PERBAIKAN: Mengirim variabel $kelases (jamak) ke view
        return view('admin.master.siswa.edit', compact('siswa', 'kelases', 'jurusans'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validator = Validator::make($request->all(), [
            'nama_siswa'    => 'sometimes|required|string|max:255',
            'nis'           => ['sometimes', 'required', 'string', 'max:255', Rule::unique('siswas')->ignore($siswa->id)],
            'email'         => ['sometimes', 'required', 'email', Rule::unique('siswas')->ignore($siswa->id)],
            'kelas_id'      => 'sometimes|required|exists:kelas,id',
            'jurusan_id'    => 'sometimes|required|exists:jurusans,id',
            'tanggal_lahir' => 'sometimes|required|date',
            'alamat'        => 'sometimes|required|string',
            'jenis_kelamin' => ['sometimes', 'required', Rule::in(['L', 'P'])],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        try {
            $siswa->update($validator->validated());
            return redirect()->route('admin.master.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal memperbarui siswa: ' . $th->getMessage())->withInput();
        }
    }

    public function destroy(Siswa $siswa)
    {
        try {
            $siswa->delete();
            return redirect()->route('admin.master.siswa.index')->with('success', 'Siswa berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.master.siswa.index')->with('error', 'Gagal menghapus siswa: ' . $th->getMessage());
        }
    }
}
