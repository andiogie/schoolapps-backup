<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    /**
     * Menampilkan form untuk mengedit profil admin yang sedang login.
     */
    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.edit', ['admin' => $admin]);
    }

    /**
     * Memperbarui informasi profil admin yang sedang login.
     */
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update data admin (email tidak di-update karena sebagai pengenal)
        $admin->name = $validatedData['name'];

        // Jika password diisi, update password
        if (!empty($validatedData['password'])) {
            $admin->password = Hash::make($validatedData['password']);
        }

        $admin->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.profile.edit')->with('status', 'Profil berhasil diperbarui!');
    }
}
