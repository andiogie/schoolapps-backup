<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KalenderSekolah;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KalenderSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kalenderSekolah = KalenderSekolah::with('tahunAjaran')->latest()->paginate(10);
        return view('admin.kalender-sekolah.index', compact('kalenderSekolah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahunAjarans = TahunAjaran::where('is_active', true)->get();
        return view('admin.kalender-sekolah.create', compact('tahunAjarans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'nullable|string',
        ]);

        $validatedData['is_active'] = true;

        KalenderSekolah::create($validatedData);

        return redirect()->route('admin.kalender-sekolah.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KalenderSekolah $kalenderSekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KalenderSekolah $kalenderSekolah)
    {
        $tahunAjarans = TahunAjaran::where('is_active', true)->get();
        return view('admin.kalender-sekolah.edit', compact('kalenderSekolah', 'tahunAjarans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KalenderSekolah $kalenderSekolah)
    {
        $validatedData = $request->validate([
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'nullable|string',
        ]);

        $validatedData['is_active'] = $request->has('is_active');

        $kalenderSekolah->update($validatedData);

        return redirect()->route('admin.kalender-sekolah.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KalenderSekolah $kalenderSekolah)
    {
        //
    }

    public function getEvents()
    {
        $events = KalenderSekolah::all()->map(function ($item) {
            return [
                'title' => $item->nama_kegiatan,
                'start' => $item->tanggal_mulai,
                'end' => Carbon::parse($item->tanggal_selesai)->addDay()->toDateString(),
                'backgroundColor' => '#34D399', // Hijau limau
                'borderColor' => '#34D399',
                'extendedProps' => [
                    'description' => $item->keterangan
                ]
            ];
        });

        return response()->json($events);
    }
}
