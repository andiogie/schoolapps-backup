<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        $kepalaSekolah = Guru::where('is_kepala_sekolah', 1)->first();
        $namaKepalaSekolahOtomatis = $kepalaSekolah ? $kepalaSekolah->nama : null;

        if ($profil) {
            // Jika profil sudah ada, tampilkan halaman edit
            if ($namaKepalaSekolahOtomatis && !$profil->nama_kepala_sekolah) {
                $profil->nama_kepala_sekolah = $namaKepalaSekolahOtomatis;
            }
            return view('admin.profil-sekolah.edit', compact('profil', 'namaKepalaSekolahOtomatis'));
        } else {
            // Jika profil belum ada, tampilkan halaman create
            return view('admin.profil-sekolah.create', compact('namaKepalaSekolahOtomatis'));
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'nama_kepala_sekolah' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);

        $createData = $request->except(['_token', 'logo']);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $fileName = 'logo-sekolah-' . time() . '.' . $logo->getClientOriginalExtension();
            $publicPath = 'storage/logos';
            $logo->move(public_path($publicPath), $fileName);
            $createData['logo_path'] = $publicPath . '/' . $fileName;
        }

        ProfilSekolah::create($createData);

        Artisan::call('config:clear');

        return redirect()->route('admin.profil-sekolah.index')
                         ->with('success', 'Profil Sekolah berhasil dibuat.');
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'nama_kepala_sekolah' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);

        $profil = ProfilSekolah::findOrFail($id);
        $updateData = $request->except(['_token', '_method', 'logo']);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $fileName = 'logo-sekolah-' . time() . '.' . $logo->getClientOriginalExtension();
            $publicPath = 'storage/logos';

            if ($profil->logo_path && File::exists(public_path($profil->logo_path))) {
                File::delete(public_path($profil->logo_path));
            }

            $logo->move(public_path($publicPath), $fileName);
            $updateData['logo_path'] = $publicPath . '/' . $fileName;
        } else {
            $updateData['logo_path'] = $profil->logo_path;
        }

        $profil->update($updateData);

        Artisan::call('config:clear');

        return redirect()->route('admin.profil-sekolah.index')
                         ->with('success', 'Profil Sekolah berhasil diperbarui.');
    }
}
