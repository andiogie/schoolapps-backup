<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Logika Pengalihan Cerdas Berdasarkan Peran
                if ($guard === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                if ($guard === 'guru') {
                    return redirect()->route('guru.dashboard');
                }

                if ($guard === 'siswa') {
                    return redirect()->route('siswa.dashboard');
                }

                // Fallback default jika guard tidak dikenali (seharusnya tidak terjadi)
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
