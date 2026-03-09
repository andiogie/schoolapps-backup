<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materis = Materi::where('is_active', true)
            ->with(['guru', 'mapel'])
            ->latest()
            ->get();

        return view('siswa.materi.index', compact('materis'));
    }

    /**
     * Handle the download of a material file using response()->download().
     */
    public function download(Materi $materi)
    {
        if (!$materi->is_active) {
            abort(403, 'Materi ini tidak aktif.');
        }

        $filePath = 'public/' . $materi->file_path;

        if (!Storage::exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Dapatkan path absolut dari storage untuk response()->download()
        $absolutePath = Storage::path($filePath);
        $originalName = basename($materi->file_path);

        // Gunakan response()->download() seperti yang Anda sarankan
        return response()->download($absolutePath, $originalName);
    }
}
