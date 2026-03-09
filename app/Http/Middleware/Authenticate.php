<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Routing\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            
            /** @var \Illuminate\Routing\Route|null $route */
            $route = $request->route();

            // Jika tidak ada route yang cocok (misalnya saat terjadi error), arahkan ke login default.
            if (!$route) {
                return route('login');
            }

            // Ambil guard dari middleware pertama yang terpasang pada route.
            $guard = Arr::get($route->middleware(), 0);

            // Arahkan berdasarkan guard.
            switch ($guard) {
                case 'auth:admin':
                    return route('auth.admin.login');
                case 'auth:guru':
                    return route('auth.guru.login');
                case 'auth:siswa':
                    return route('auth.siswa.login');
                default:
                    return route('login');
            }
        }
        return null;
    }
}
