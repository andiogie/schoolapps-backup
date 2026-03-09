<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Mail\PendaftaranDiterima;
use App\Jobs\SendBulkVerificationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Exception;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pendaftaran::with('jurusanRelasi')->orderBy('no_pendaftaran', 'asc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_lengkap', 'like', '%' . $search . '%');
        }

        $pendaftarans = $query->paginate(15);

        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('admin.pendaftaran.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('admin.pendaftaran.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        // Load relasi di sini juga untuk halaman detail, untuk jaga-jaga jika dibutuhkan.
        $pendaftaran->load('jurusanRelasi');
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        return redirect()->route('admin.pendaftaran.show', $pendaftaran);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => 'required|in:pending,verified,rejected',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $previousStatus = $pendaftaran->status;

        $pendaftaran->status = $request->status;
        $pendaftaran->catatan = $request->catatan;
        $pendaftaran->save();

        // Kirim email jika status diubah menjadi 'verified' dari status lain
        if ($pendaftaran->status == 'verified' && $previousStatus != 'verified') {
            try {
                // Pastikan relasi dimuat sebelum dikirim ke Mailable
                $pendaftaran->load('jurusanRelasi');
                Mail::to($pendaftaran->email)->send(new PendaftaranDiterima($pendaftaran));
                return redirect()->route('admin.pendaftaran.index')->with('success', 'Status pendaftaran untuk ' . $pendaftaran->nama_lengkap . ' berhasil diperbarui dan email notifikasi telah dikirim.');
            } catch (Exception $e) {
                // Jika email gagal, tetap lanjutkan tapi berikan peringatan
                return redirect()->route('admin.pendaftaran.show', $pendaftaran->id)->with('warning', 'Status berhasil diperbarui, tetapi email notifikasi GAGAL dikirim. Error: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Status pendaftaran untuk ' . $pendaftaran->nama_lengkap . ' berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        // Untuk saat ini, kita tidak akan mengimplementasikan penghapusan data pendaftar
        // Demi menjaga integritas data.
        return redirect()->route('admin.pendaftaran.index')->with('info', 'Fitur hapus belum diaktifkan.');
    }

    /**
     * Approve all pending pendaftarans.
     */
    public function approveAll()
    {
        $pendaftaransToApprove = Pendaftaran::where('status', 'pending')->get();

        if ($pendaftaransToApprove->isEmpty()) {
            return redirect()->route('admin.pendaftaran.index')->with('info', 'Tidak ada pendaftar dengan status pending yang perlu disetujui.');
        }

        foreach ($pendaftaransToApprove as $pendaftaran) {
            $pendaftaran->status = 'verified';
            $pendaftaran->save();

            // Dispatch job to send email (dinonaktifkan sementara)
            // SendBulkVerificationEmail::dispatch($pendaftaran);
        }

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Semua pendaftar dengan status pending telah disetujui.');
    }
}
