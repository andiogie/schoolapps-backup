<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::with('jurusanRelasi')->latest()->paginate(10);
        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }
    
    public function create()
    {
        return view('daftar');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Validasi data... (sama seperti sebelumnya)
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:pendaftarans,email',
            'nomor_kk' => 'required|string|size:16|unique:pendaftarans,nomor_kk',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:100',
            'no_hp_ortu' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:100',
            'jurusan' => 'required|string|max:100',
            'ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pernyataan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Terdapat kesalahan pada data yang Anda isikan.',
                'errors' => $validator->errors()
            ], 422);
        }

        $noPendaftaran = 'REG-' . date('Ymd') . '-' . random_int(1000, 9999);
        $ijazahPath = $request->file('ijazah')->store('dokumen_pendaftaran', 'public');

        $pendaftaran = Pendaftaran::create([
            'no_pendaftaran' => $noPendaftaran,
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'nomor_kk' => $request->nomor_kk,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'no_hp_ortu' => $request->no_hp_ortu,
            'asal_sekolah' => $request->asal_sekolah,
            'jurusan' => $request->jurusan,
            'ijazah_path' => $ijazahPath,
            'status' => 'pending',
            // Default untuk pembayaran sudah diatur di migrasi
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran berhasil! Anda akan diarahkan ke halaman pembayaran.',
            'no_pendaftaran' => $noPendaftaran,
            'redirect_url' => route('pendaftaran.show_payment_form', ['no_pendaftaran' => $noPendaftaran])
        ]);
    }

    public function showPaymentForm($no_pendaftaran)
    {
        $pendaftaran = Pendaftaran::where('no_pendaftaran', $no_pendaftaran)->firstOrFail();
        return view('pendaftaran.pembayaran', compact('pendaftaran'));
    }

    public function processPayment(Request $request, $no_pendaftaran)
    {
        $request->validate([
            'jumlah_bayar' => 'required|numeric|min:1',
            'bukti_pembayaran' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $pendaftaran = Pendaftaran::where('no_pendaftaran', $no_pendaftaran)->firstOrFail();

        $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $pendaftaran->update([
            'total_bayar' => $pendaftaran->total_bayar + $request->jumlah_bayar,
            'status_pembayaran' => 'menunggu_verifikasi',
            'bukti_pembayaran_path' => $buktiPath,
        ]);
        
        // Redirect ke halaman sukses atau dashboard siswa dengan pesan
        return redirect()->route('pendaftaran.success')->with('success', 'Pembayaran Anda telah diterima dan sedang menunggu verifikasi.');
    }
    
    public function verify($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Validasi pembayaran 50%
        if (($pendaftaran->total_bayar / $pendaftaran->total_biaya) < 0.5) {
            return redirect()->back()->with('error', 'Verifikasi gagal! Pembayaran pendaftar belum mencapai 50%.');
        }

        $pendaftaran->update(['status' => 'verified']);
        
        // Logika tambahan: kirim email notifikasi, buat user siswa, dll.

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran berhasil diverifikasi.');
    }

    public function reject(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'status' => 'rejected',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran berhasil ditolak.');
    }

    public function success()
    {
        return view('pendaftaran.sukses');
    }
}
