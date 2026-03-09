<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GuruAuthController extends Controller
{
    /**
     * Tampilkan halaman login guru
     */
    public function showLoginForm()
    {
        return view('auth.guru-login');
    }

    /**
     * Proses login guru
     */
    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required'
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = [
            'nip' => $request->nip,
            'password' => $request->password,
            'is_active' => 1,
        ];

        if (Auth::guard('guru')->attempt($credentials)) {
            $request->session()->regenerate();
            // Menambahkan pesan sukses untuk SweetAlert
            return redirect()->route('guru.dashboard')->with('success', 'Anda berhasil login. Selamat datang!');
        }

        // Menggunakan with('error', ...) agar bisa ditangkap SweetAlert
        return back()->with('error', 'NIP atau password salah, atau akun Anda tidak aktif.')->withInput($request->only('nip'));
    }

    /**
     * Logout guru dengan pembersihan sesi total
     */
    public function logout(Request $request)
    {
        Auth::guard('guru')->logout();

        $request->session()->flush();
        $request->session()->regenerateToken();

        // Menambahkan pesan sukses setelah logout
        return redirect()->route('auth.guru.login')->with('success', 'Anda telah berhasil logout.');
    }
}
