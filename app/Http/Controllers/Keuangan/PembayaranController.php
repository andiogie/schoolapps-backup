<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with(['siswa', 'tahunAjaran'])->latest()->get();
        return view('keuangan.pembayaran.index', compact('pembayarans'));
    }

    public function create(Request $request)
    {
        // PERBAIKAN: Menggunakan kolom 'is_active' yang benar untuk mengambil tahun ajaran.
        $tahunAjarans = TahunAjaran::where('is_active', 1)->get();
        $siswas = null;
        $selectedSiswa = null;

        if ($request->has('search')) {
            $searchQuery = $request->input('search');
            $siswas = Siswa::where(function ($q) use ($searchQuery) {
                    $q->whereRaw('LOWER(nama_siswa) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
                      ->orWhere('nis', 'LIKE', '%' . $searchQuery . '%');
                })
                ->with('kelas')
                ->limit(10)
                ->get();
        }

        if ($request->has('siswa_id')) {
            $selectedSiswa = Siswa::with('kelas')->find($request->input('siswa_id'));
        }

        return view('keuangan.pembayaran.create', compact('tahunAjarans', 'siswas', 'selectedSiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'tanggal_bayar' => 'required|date',
            'bulan_spp' => 'required|integer|between:1,12',
            'tahun_spp' => 'required|integer|min:1990',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tipe_pembayaran' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $existingPayment = Pembayaran::where('siswa_id', $request->siswa_id)
            ->where('bulan_spp', $request->bulan_spp)
            ->where('tahun_spp', $request->tahun_spp)
            ->first();

        if ($existingPayment) {
            return back()->withInput()->withErrors(['duplicate' => 'SPP untuk siswa ini pada bulan dan tahun tersebut sudah pernah dibayar.']);
        }

        Pembayaran::create($request->all());

        return redirect()->route('admin.keuangan.pembayaran.index')->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function show(Pembayaran $pembayaran)
    {
        return view('keuangan.pembayaran.show', compact('pembayaran'));
    }

    public function edit(Pembayaran $pembayaran)
    {
        // PERBAIKAN: Menggunakan kolom 'is_active' yang benar di sini juga.
        $tahunAjarans = TahunAjaran::where('is_active', 1)->get();
        return view('keuangan.pembayaran.edit', compact('pembayaran', 'tahunAjarans'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'tanggal_bayar' => 'required|date',
            'bulan_spp' => 'required|integer|between:1,12',
            'tahun_spp' => 'required|integer|min:1990',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tipe_pembayaran' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $existingPayment = Pembayaran::where('siswa_id', $pembayaran->siswa_id)
            ->where('bulan_spp', $request->bulan_spp)
            ->where('tahun_spp', $request->tahun_spp)
            ->where('id', '!=', $pembayaran->id)
            ->first();
        
        if ($existingPayment) {
            return back()->withInput()->withErrors(['duplicate' => 'SPP untuk siswa ini pada bulan dan tahun tersebut sudah pernah dibayar.']);
        }

        $pembayaran->update($request->all());

        return redirect()->route('admin.keuangan.pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('admin.keuangan.pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus.');
    }
}
