<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiswaAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.siswa-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nis' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'nis' => $request->nis,
            'password' => $request->password,
            'is_active' => true,
        ];

        if (Auth::guard('siswa')->attempt($credentials)) {
            $request->session()->regenerate();
            // Menambahkan pesan sukses untuk SweetAlert
            return redirect()->route('siswa.dashboard')->with('success', 'Anda berhasil login. Selamat datang!');
        }

        // Menggunakan with('error', ...) agar bisa ditangkap SweetAlert
        return back()->with('error', 'NIS atau password salah, atau akun Anda tidak aktif.')->withInput($request->only('nis'));
    }

    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();

        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Menambahkan pesan sukses setelah logout
        return redirect()->route('auth.siswa.login')->with('success', 'Anda telah berhasil logout.');
    }
}
