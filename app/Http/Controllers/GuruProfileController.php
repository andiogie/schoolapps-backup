<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class GuruProfileController extends Controller
{
    /**
     * Menampilkan halaman dashboard guru.
     */
    public function dashboard()
    {
        return view('guru.index');
    }
    /**
     * Menampilkan halaman profil guru.
     */
    public function show()
    {
        $guru = Auth::guard('guru')->user();
        return view('guru.profil.show', compact('guru'));
    }

    /**
     * Menampilkan form untuk mengubah password.
     */
    public function showChangePasswordForm()
    {
        return view('guru.profil.change-password');
    }

    /**
     * Memperbarui password guru.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::guard('guru')->user()->password)) {
                    $fail('Password lama tidak sesuai.');
                }
            }],
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.min' => 'Password baru minimal harus 8 karakter.',
        ]);

        $guru = Auth::guard('guru')->user();
        $guru->password = Hash::make($request->password);
        $guru->save();

        return redirect()->route('guru.profil.show')->with('status', 'Password berhasil diperbarui!');
    }
}
