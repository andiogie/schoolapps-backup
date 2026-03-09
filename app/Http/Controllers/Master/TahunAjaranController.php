<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class TahunAjaranController extends Controller
{
    // =================================================================================
    // =========== METHOD UNTUK ADMIN PANEL (MENGEMBALIKAN VIEW) =======================
    // =================================================================================

    public function index()
    {
        $tahunAjarans = TahunAjaran::orderBy('id', 'asc')->get();
        return view('admin.master.tahun-ajaran.index', compact('tahunAjarans'));
    }

    public function create()
    {
        $years = [];
        $currentYear = Carbon::now()->year;
        for ($i = -5; $i <= 5; $i++) {
            $startYear = $currentYear + $i;
            $endYear = $startYear + 1;
            $years[] = $startYear . ' - ' . $endYear;
        }

        return view('admin.master.tahun-ajaran.create', compact('years'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => [
                'required',
                'regex:/^\d{4} - \d{4}$/',
                Rule::unique('tahun_ajarans')->where(function ($query) use ($request) {
                    return $query->where('semester', $request->semester);
                }),
            ],
            'semester' => 'required|in:Ganjil,Genap',
            'is_active' => 'sometimes|boolean',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $isActive = $request->input('is_active', false);

                if ($isActive) {
                    TahunAjaran::where('is_active', true)->update(['is_active' => false]);
                }

                TahunAjaran::create([
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'semester' => $request->semester,
                    'is_active' => $isActive,
                ]);
            });
            
            Log::info('Tahun ajaran baru telah ditambahkan', ['tahun_ajaran' => $request->tahun_ajaran, 'semester' => $request->semester]);

            return redirect()->route('admin.master.tahun-ajaran.index')->with('success', 'Tahun Ajaran berhasil ditambahkan.');
        } catch (\Throwable $th) {
            Log::error('Gagal menambahkan tahun ajaran', ['error' => $th->getMessage()]);
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan Tahun Ajaran.');
        }
    }
    
    public function edit(TahunAjaran $tahunAjaran)
    {
        $years = [];
        $currentYear = Carbon::now()->year;
        for ($i = -5; $i <= 5; $i++) {
            $startYear = $currentYear + $i;
            $endYear = $startYear + 1;
            $years[] = $startYear . ' - ' . $endYear;
        }

        return view('admin.master.tahun-ajaran.edit', compact('tahunAjaran', 'years'));
    }

    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $request->validate([
            'tahun_ajaran' => [
                'required',
                'regex:/^\d{4} - \d{4}$/',
                 Rule::unique('tahun_ajarans')->where(function ($query) use ($request, $tahunAjaran) {
                    return $query->where('semester', $request->input('semester', $tahunAjaran->semester));
                })->ignore($tahunAjaran->id),
            ],
            'semester' => 'required|in:Ganjil,Genap',
            'is_active' => 'sometimes|boolean',
        ]);

        try {
            DB::transaction(function () use ($request, $tahunAjaran) {
                if ($request->has('is_active')) {
                    $isActive = $request->boolean('is_active');
                    if ($isActive) {
                        TahunAjaran::where('id', '!=', $tahunAjaran->id)->update(['is_active' => false]);
                    }
                    $tahunAjaran->is_active = $isActive;
                } else {
                     $tahunAjaran->is_active = $request->input('is_active', false);
                }

                $tahunAjaran->tahun_ajaran = $request->tahun_ajaran;
                $tahunAjaran->semester = $request->semester;

                $tahunAjaran->save();
            });

            Log::info('Tahun ajaran telah diperbarui', ['id' => $tahunAjaran->id]);

            return redirect()->route('admin.master.tahun-ajaran.index')->with('success', 'Tahun Ajaran berhasil diperbarui.');
        } catch (\Throwable $th) {
            Log::error('Gagal memperbarui tahun ajaran', ['error' => $th->getMessage()]);
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui Tahun Ajaran.');
        }
    }

    public function destroy(TahunAjaran $tahunAjaran)
    {
        // Walaupun tidak ada tombolnya, lebih baik sediakan methodnya untuk mencegah error
        return redirect()->route('admin.master.tahun-ajaran.index')->with('warning', 'Penghapusan Tahun Ajaran tidak diizinkan.');
    }


    // =================================================================================
    // ================== METHOD UNTUK API (MENGEMBALIKAN JSON) ========================
    // =================================================================================

    public function apiIndex(): JsonResponse
    {
        $tahunAjarans = TahunAjaran::orderBy('id', 'asc')->get();
        return response()->json($tahunAjarans);
    }

    public function apiStore(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tahun_ajaran' => [
                'required',
                'regex:/^\d{4} - \d{4}$/',
                Rule::unique('tahun_ajarans')->where(function ($query) use ($request) {
                    return $query->where('semester', $request->semester);
                }),
            ],
            'semester' => 'required|in:Ganjil,Genap',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            DB::transaction(function () use ($request) {
                $isActive = $request->input('is_active', false);

                if ($isActive) {
                    TahunAjaran::where('is_active', true)->update(['is_active' => false]);
                }

                TahunAjaran::create([
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'semester' => $request->semester,
                    'is_active' => $isActive,
                ]);
            });

            return response()->json(['message' => 'Tahun Ajaran berhasil ditambahkan.'], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Gagal menambahkan Tahun Ajaran.', 'error' => $th->getMessage()], 500);
        }
    }

    public function apiUpdate(Request $request, $id): JsonResponse
    {
        $tahunAjaran = TahunAjaran::find($id);
        if (!$tahunAjaran) {
            return response()->json(['message' => 'Tahun Ajaran tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'tahun_ajaran' => [
                'sometimes',
                'required',
                'regex:/^\d{4} - \d{4}$/',
                Rule::unique('tahun_ajarans')->where(function ($query) use ($request, $tahunAjaran) {
                    return $query->where('semester', $request->input('semester', $tahunAjaran->semester));
                })->ignore($id),
            ],
            'semester' => 'sometimes|required|in:Ganjil,Genap',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            DB::transaction(function () use ($request, $tahunAjaran) {
                if ($request->has('is_active')) {
                    $isActive = $request->boolean('is_active');
                    if ($isActive) {
                        TahunAjaran::where('id', '!=', $tahunAjaran->id)->update(['is_active' => false]);
                    }
                    $tahunAjaran->is_active = $isActive;
                }

                if ($request->has('tahun_ajaran')) {
                    $tahunAjaran->tahun_ajaran = $request->tahun_ajaran;
                }
                if ($request->has('semester')) {
                    $tahunAjaran->semester = $request->semester;
                }

                $tahunAjaran->save();
            });

            return response()->json(['message' => 'Tahun Ajaran berhasil diperbarui.', 'data' => $tahunAjaran]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Gagal memperbarui Tahun Ajaran.', 'error' => $th->getMessage()], 500);
        }
    }

    // Tidak ada apiDestroy karena data ini krusial dan tidak seharusnya dihapus
}
