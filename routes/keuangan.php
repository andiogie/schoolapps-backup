<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Keuangan\PembayaranController;
use App\Http\Controllers\Master\SiswaController;

/*
|--------------------------------------------------------------------------
| Keuangan Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan semua rute yang berkaitan dengan modul
| keuangan. Rute-rute ini akan dimuat oleh RouteServiceProvider
| dan secara otomatis akan diberi prefix 'admin' dan middleware 'admin'
|
*/

// Rute untuk mencari siswa (AJAX)
Route::get('cari-siswa', [SiswaController::class, 'search'])->name('siswa.search');

Route::resource('pembayaran', PembayaranController::class)->except([
    'destroy'
]);
