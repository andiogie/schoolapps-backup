<?php

namespace App\Providers;

use Illuminate\Foundation\Vite;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\Config;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Vite $vite): void
    {
        Paginator::useBootstrapFive();

        $vite->useScriptTagAttributes([
            'crossorigin' => 'anonymous',
        ]);

        // Atur lokal aplikasi ke Bahasa Indonesia
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        // Bagikan data profil sekolah dan atur konfigurasi email secara dinamis
        // Pengecekan Schema::hasTable() penting untuk mencegah error saat migrasi awal
        if (Schema::hasTable('profil_sekolahs')) {
            $profilSekolah = ProfilSekolah::first();
            
            // Bagikan data ke semua view agar bisa diakses di Blade
            View::share('profilSekolah', $profilSekolah);

            // Jika data profil sekolah ada, timpa konfigurasi email default
            if ($profilSekolah) {
                Config::set('mail.from.address', $profilSekolah->email);
                Config::set('mail.from.name', $profilSekolah->nama_sekolah);
                Config::set('app.name', $profilSekolah->nama_sekolah);
            }

        } else {
            // Jika tabel belum ada, bagikan null agar tidak error
            View::share('profilSekolah', null);
        }
    }
}
