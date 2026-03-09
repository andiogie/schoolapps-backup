<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\JurusanController as MasterJurusanController;
use App\Http\Controllers\Master\KelasController as MasterKelasController;
use App\Http\Controllers\Master\GuruController as MasterGuruController;
use App\Http\Controllers\Master\MapelController as MasterMapelController;
use App\Http\Controllers\Master\SiswaController as MasterSiswaController;
use App\Http\Controllers\Master\TahunAjaranController as MasterTahunAjaranController;
use App\Http\Controllers\Master\JadwalPelajaranController as MasterJadwalPelajaranController;
use App\Http\Controllers\Master\FasilitasController as MasterFasilitasController; // Impor FasilitasController
use App\Http\Controllers\Api\KalenderEventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Grup rute untuk API v1
Route::prefix('v1')->group(function () {
    // Rute untuk Jurusan
    Route::get('jurusan', [MasterJurusanController::class, 'apiIndex']);
    Route::post('jurusan', [MasterJurusanController::class, 'apiStore']);
    Route::put('jurusan/{id}', [MasterJurusanController::class, 'apiUpdate']);
    Route::delete('jurusan/{id}', [MasterJurusanController::class, 'apiDestroy']);

    // Rute untuk Kelas
    Route::get('kelas', [MasterKelasController::class, 'apiIndex']);
    Route::post('kelas', [MasterKelasController::class, 'apiStore']);
    Route::put('kelas/{id}', [MasterKelasController::class, 'apiUpdate']);
    Route::delete('kelas/{id}', [MasterKelasController::class, 'apiDestroy']);

    // Rute untuk Guru
    Route::get('guru', [MasterGuruController::class, 'apiIndex']);
    Route::post('guru', [MasterGuruController::class, 'apiStore']);
    Route::put('guru/{id}', [MasterGuruController::class, 'apiUpdate']);
    Route::delete('guru/{id}', [MasterGuruController::class, 'apiDestroy']);

    // Rute untuk Mapel
    Route::get('mapel', [MasterMapelController::class, 'apiIndex']);
    Route::post('mapel', [MasterMapelController::class, 'apiStore']);
    Route::put('mapel/{id}', [MasterMapelController::class, 'apiUpdate']);
    Route::delete('mapel/{id}', [MasterMapelController::class, 'apiDestroy']);

    // Rute untuk Siswa
    Route::get('siswa', [MasterSiswaController::class, 'apiIndex']);
    Route::post('siswa', [MasterSiswaController::class, 'apiStore']);
    Route::put('siswa/{id}', [MasterSiswaController::class, 'apiUpdate']);
    Route::delete('siswa/{id}', [MasterSiswaController::class, 'apiDestroy']);

    // Rute untuk Tahun Ajaran
    Route::get('tahun-ajaran', [MasterTahunAjaranController::class, 'apiIndex']);
    Route::post('tahun-ajaran', [MasterTahunAjaranController::class, 'apiStore']);
    Route::put('tahun-ajaran/{id}', [MasterTahunAjaranController::class, 'apiUpdate']);

    // Rute untuk Jadwal Pelajaran
    Route::get('jadwal-pelajaran', [MasterJadwalPelajaranController::class, 'apiIndex']);
    Route::post('jadwal-pelajaran', [MasterJadwalPelajaranController::class, 'apiStore']);
    Route::put('jadwal-pelajaran/{id}', [MasterJadwalPelajaranController::class, 'apiUpdate']);
    Route::delete('jadwal-pelajaran/{id}', [MasterJadwalPelajaranController::class, 'apiDestroy']);

    // Rute untuk Kalender Event
    Route::get('kalender-events', [KalenderEventController::class, 'index']);

    // Rute untuk Fasilitas
    Route::get('fasilitas', [MasterFasilitasController::class, 'apiIndex']);
    Route::post('fasilitas', [MasterFasilitasController::class, 'apiStore']);
});
