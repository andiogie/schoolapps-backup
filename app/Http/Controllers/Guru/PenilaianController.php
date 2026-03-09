<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function update(Request $request, PengumpulanTugas $pengumpulanTugas)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        $pengumpulanTugas->update([
            'nilai' => $request->nilai,
        ]);

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    }
}
