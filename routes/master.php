<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\MapelController;
use App\Http\Controllers\Master\JurusanController;
use App\Http\Controllers\Master\KelasController;
use App\Http\Controllers\Master\SiswaController;
use App\Http\Controllers\Master\GuruController;
use App\Http\Controllers\Master\TahunAjaranController;
use App\Http\Controllers\Master\JadwalPelajaranController;
use App\Http\Controllers\Master\FasilitasController; // <-- Impor FasilitasController

/*
|--------------------------------------------------------------------------
| Master Routes
|--------------------------------------------------------------------------
*/

// Rute untuk Mata Pelajaran
Route::post('mapel/import', [MapelController::class, 'import'])->name('mapel.import');
Route::resource('mapel', MapelController::class)->except([
    'show'
]);

Route::resource('jurusan', JurusanController::class)->except([
    'show'
]);
Route::resource('kelas', KelasController::class)->except([
    'show'
]);

// Rute untuk Siswa
Route::get('siswa/search', [SiswaController::class, 'search'])->name('siswa.search');
Route::get('siswa/search-pendaftar', [SiswaController::class, 'searchPendaftar'])->name('siswa.searchPendaftar');
Route::post('siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
Route::resource('siswa', SiswaController::class)->except([
    'show'
]);

// Rute untuk Guru
Route::post('guru/import', [GuruController::class, 'import'])->name('guru.import');
Route::resource('guru', GuruController::class)->except([
    'show'
]);

Route::post('tahun-ajaran/{tahun_ajaran}/activate', [TahunAjaranController::class, 'activate'])->name('tahun-ajaran.activate');
Route::resource('tahun-ajaran', TahunAjaranController::class, [
    'parameters' => ['tahun-ajaran' => 'tahun_ajaran']
])->except([
    'show'
]);

Route::resource('jadwal-pelajaran', JadwalPelajaranController::class)->except([
    'show'
]);

// Rute untuk Fasilitas
Route::resource('fasilitas', FasilitasController::class)->except([
    'show'
]);
