<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IzinGuru;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riwayatIzin = IzinGuru::where('guru_id', Auth::guard('guru')->id())->orderBy('created_at', 'desc')->get();
        return view('guru.izin.index', compact('riwayatIzin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.izin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_izin' => 'required|string',
            'alasan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'file_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('file_pendukung')) {
            $path = $request->file('file_pendukung')->store('public/surat_izin');
        }

        IzinGuru::create([
            'guru_id' => Auth::guard('guru')->id(),
            'jenis_izin' => $request->jenis_izin,
            'alasan' => $request->alasan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'file_pendukung' => $path,
            'status' => 'Diajukan',
        ]);

        return redirect()->route('guru.izin.index')->with('success', 'Pengajuan izin berhasil dikirim.');
    }
}
