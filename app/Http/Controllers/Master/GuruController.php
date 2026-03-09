<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use League\Csv\Reader;

class GuruController extends Controller
{
    // =================================================================================
    // =========== METHOD UNTUK ADMIN PANEL (MENGEMBALIKAN VIEW) =======================
    // =================================================================================
    public function index(Request $request)
    {
        $query = Guru::with('mapel', 'kelasWali')->orderBy('id', 'asc');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nip', 'like', '%' . $search . '%');
            });
        }
        $gurus = $query->paginate(15);
        return view('admin.master.guru.index', compact('gurus'));
    }

    public function create()
    {
        $mapels = Mapel::all();
        return view('admin.master.guru.create', compact('mapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:gurus',
            'email' => 'required|email|unique:gurus',
            'mapel_id' => 'required|exists:mapels,id',
        ]);
        try {
            $password = 'password'; // Default password

            Guru::create([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'email' => $request->email,
                'mapel_id' => $request->mapel_id,
                'password' => Hash::make($password),
                'is_active' => true, 
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data guru: ' . $e->getMessage())->withInput();
        }
        return redirect()->route('admin.master.guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru)
    {
        $mapels = Mapel::all();
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $guru->load('kelasWali');
        return view('admin.master.guru.edit', compact('guru', 'mapels', 'kelas'));
    }

    public function update(Request $request, Guru $guru)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:255',
            'nip' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('gurus')->ignore($guru->id)],
            'email' => ['sometimes', 'required', 'email', Rule::unique('gurus')->ignore($guru->id)],
            'mapel_id' => 'sometimes|required|exists:mapels,id',
            'password' => 'sometimes|nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $updateData = $request->except('password', 'is_active');

            // Handle boolean is_active from checkbox
            $updateData['is_active'] = $request->has('is_active');

            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }
            $guru->update($updateData);
            return redirect()->route('admin.master.guru.index')->with('success', 'Data guru berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data guru: ' . $e->getMessage())->withInput();
        }
    }
    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        try {
            $file = $request->file('file');
            $csv = Reader::createFromPath($file->getRealPath(), 'r');
            $csv->setHeaderOffset(0);

            $errors = [];
            $successCount = 0;

            foreach ($csv as $row) {
                $validator = Validator::make($row, [
                    'nama' => 'required|string|max:255',
                    'nip' => 'required|string|max:255|unique:gurus,nip',
                    'email' => 'required|email|max:255|unique:gurus,email',
                    'mapel_id' => 'required|exists:mapels,id',
                ]);

                if ($validator->fails()) {
                    $errors[] = 'Baris ' . ($csv->getOffset() + 1) . ': ' . implode(', ', $validator->errors()->all());
                    continue;
                }
                
                $password = 'password'; // Default password

                Guru::create([
                    'nama' => $row['nama'],
                    'nip' => $row['nip'],
                    'email' => $row['email'],
                    'mapel_id' => $row['mapel_id'],
                    'password' => Hash::make($password),
                    'is_active' => true,
                ]);
                $successCount++;
            }

            $message = $successCount . ' data guru berhasil diimpor.';
            if (count($errors) > 0) {
                $errorMsg = $message . ' Namun, terjadi beberapa error:<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
                return redirect()->back()->with('error', $errorMsg);
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses file: ' . $e->getMessage());
        }
    }

    public function destroy(Guru $guru)
    {
        try {
            DB::transaction(function () use ($guru) {
                Kelas::where('wali_kelas_id', $guru->id)->update(['wali_kelas_id' => null]);
                $guru->delete();
            });
            return redirect()->route('admin.master.guru.index')->with('success', 'Guru berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.master.guru.index')->with('error', 'Gagal menghapus guru: ' . $e->getMessage());
        }
    }

    // =================================================================================
    // ================== METHOD UNTUK API (MENGEMBALIKAN JSON) ========================
    // =================================================================================

    public function apiIndex(Request $request): JsonResponse
    {
        $query = Guru::with('mapel', 'kelasWali')->orderBy('id', 'asc');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')->orWhere('nip', 'like', '%' . $search . '%');
            });
        }
        $gurus = $query->paginate(15);
        return response()->json($gurus);
    }

    public function apiStore(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:gurus,nip',
            'email' => 'required|email|max:255|unique:gurus,email',
            'mapel_id' => 'required|exists:mapels,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $password = 'password'; // Default password
            $hashedPassword = Hash::make($password);
            
            $guru = Guru::create([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'email' => $request->email,
                'mapel_id' => $request->mapel_id,
                'password' => $hashedPassword,
                'is_active' => true,
            ]);

            $guru->load('mapel');
            return response()->json(['message' => 'Guru berhasil ditambahkan.', 'data' => $guru], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menyimpan data guru.', 'error' => $e->getMessage()], 500);
        }
    }

    public function apiUpdate(Request $request, $id): JsonResponse
    {
        $guru = Guru::find($id);
        if (!$guru) {
            return response()->json(['message' => 'Guru tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:255',
            'nip' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('gurus')->ignore($id)],
            'email' => ['sometimes', 'required', 'email', Rule::unique('gurus')->ignore($id)],
            'mapel_id' => 'sometimes|required|exists:mapels,id',
            'password' => 'sometimes|nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $updateData = $request->except('password', 'is_active');

            // Handle boolean is_active from checkbox
            $updateData['is_active'] = $request->has('is_active');

            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }
            $guru->update($updateData);

            $guru->load('mapel', 'kelasWali');
            return response()->json(['message' => 'Guru berhasil diperbarui.', 'data' => $guru]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal memperbarui data guru.', 'error' => $e->getMessage()], 500);
        }
    }

    public function apiDestroy($id): JsonResponse
    {
        $guru = Guru::find($id);
        if (!$guru) {
            return response()->json(['message' => 'Guru tidak ditemukan.'], 404);
        }

        try {
            DB::transaction(function () use ($guru) {
                Kelas::where('wali_kelas_id', $guru->id)->update(['wali_kelas_id' => null]);
                $guru->delete();
            });

            return response()->json(['message' => 'Guru berhasil dihapus.'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data guru.', 'error' => $e->getMessage()], 500);
        }
    }
}
