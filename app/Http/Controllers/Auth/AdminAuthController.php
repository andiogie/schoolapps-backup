<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials['is_active'] = 1;

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            // Menambahkan pesan sukses untuk SweetAlert
            return redirect()->route('admin.dashboard')->with('success', 'Anda berhasil login. Selamat datang!');
        }

        // Menggunakan with('error', ...) agar bisa ditangkap SweetAlert
        return back()->with('error', 'Kredensial yang diberikan tidak cocok dengan catatan kami atau akun Anda tidak aktif.');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Menambahkan pesan sukses setelah logout
        return redirect()->route('auth.admin.login')->with('success', 'Anda telah berhasil logout.');
    }
}
