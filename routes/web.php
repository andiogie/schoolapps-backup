<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SiswaAuthController;
use App\Http\Controllers\Auth\GuruAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\GuruProfileController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\Guru\AbsensiGuruController;
use App\Http\Controllers\Guru\IzinController;
use App\Http\Controllers\Guru\TugasController as GuruTugasController;
use App\Http\Controllers\Guru\MateriController;
use App\Http\Controllers\Guru\PenilaianController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\KepalaSekolah\IzinController as KepalaSekolahIzinController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Siswa\AbsensiSiswaController;
use App\Http\Controllers\Siswa\TugasController as SiswaTugasController;
use App\Http\Controllers\Siswa\MateriController as SiswaMateriController;
use App\Http\Controllers\Admin\KalenderSekolahController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\Admin\ProfilSekolahController;
use App\Http\Controllers\Admin\JamPelajaranController;
use App\Http\Controllers\Admin\JadwalPelajaranController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PageController; // Import PageController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ======= ROOT =======
Route::get('/', function () {
    return view('index');
});

Route::get('/daftar', [PendaftaranController::class, 'create'])->name('daftar');
Route::post('/daftar', [PendaftaranController::class, 'store'])->name('daftar.store');

// ======= BREEZE DASHBOARD =======
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ======= BREEZE PROFILE =======
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ======= SISWA AUTH =======
Route::prefix('auth')->group(function () {
    Route::get('/siswa-login', [SiswaAuthController::class, 'showLoginForm'])->name('auth.siswa.login');
    Route::post('/siswa-login', [SiswaAuthController::class, 'login'])->name('auth.siswa.login.submit');
    Route::post('/siswa-logout', [SiswaAuthController::class, 'logout'])->name('auth.siswa.logout');
});

// ======= SISWA DASHBOARD & MODULES (Middleware Diperbarui) =======
Route::middleware(['auth:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard');
    Route::get('/profil', [SiswaController::class, 'showProfil'])->name('profil.show');
    Route::get('/profil/change-password', [SiswaController::class, 'showChangePasswordForm'])->name('profil.change-password');
    Route::patch('/profil/change-password', [SiswaController::class, 'updatePassword'])->name('profil.update-password');
    Route::get('/absensi/create', [AbsensiSiswaController::class, 'create'])->name('absensi.create');
    Route::post('/absensi', [AbsensiSiswaController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/riwayat', [AbsensiSiswaController::class, 'riwayat'])->name('absensi.riwayat');
    Route::get('/tugas', [SiswaTugasController::class, 'index'])->name('tugas.index');
    Route::get('/tugas/{tugas}', [SiswaTugasController::class, 'show'])->name('tugas.show');
    Route::post('/tugas/{tugas}', [SiswaTugasController::class, 'store'])->name('tugas.store');
    Route::get('/materi', [SiswaMateriController::class, 'index'])->name('materi.index');
    Route::get('/materi/{materi}/download', [SiswaMateriController::class, 'download'])->name('materi.download');
    Route::get('/kalender', [SiswaController::class, 'showKalender'])->name('kalender.index');
    Route::get('/rapor', [RaporController::class, 'showRaporSiswa'])->name('rapor.show');
    Route::get('/rapor/download', [RaporController::class, 'downloadRaporSiswa'])->name('rapor.download');
});

// ======= GURU AUTH =======
Route::prefix('auth')->group(function () {
    Route::get('/guru-login', [GuruAuthController::class, 'showLoginForm'])->name('auth.guru.login');
    Route::post('/guru-login', [GuruAuthController::class, 'login'])->name('auth.guru.login.submit');
    Route::post('/guru-logout', [GuruAuthController::class, 'logout'])->name('auth.guru.logout');
});

// ======= GURU DASHBOARD & MODULES (Middleware Diperbarui) =======
Route::middleware(['auth:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profil', [GuruProfileController::class, 'show'])->name('profil.show');
    Route::get('/profil/change-password', [GuruProfileController::class, 'showChangePasswordForm'])->name('profil.change-password');
    Route::patch('/profil/change-password', [GuruProfileController::class, 'updatePassword'])->name('profil.update-password');
    Route::get('/absensi/create', [AbsensiGuruController::class, 'create'])->name('absensi.create');
    Route::post('/absensi', [AbsensiGuruController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/riwayat', [AbsensiGuruController::class, 'riwayat'])->name('absensi.riwayat');
    Route::get('/izin', [IzinController::class, 'index'])->name('izin.index');
    Route::get('/izin/create', [IzinController::class, 'create'])->name('izin.create');
    Route::post('/izin', [IzinController::class, 'store'])->name('izin.store');
    Route::resource('/tugas', GuruTugasController::class)->except(['destroy']);
    Route::resource('/materi', MateriController::class)->except(['destroy']);
    Route::patch('/materi/{materi}/status', [MateriController::class, 'updateStatus'])->name('materi.updateStatus');
    Route::patch('/penilaian/{pengumpulanTugas}', [PenilaianController::class, 'update'])->name('penilaian.update');
    Route::get('/kalender', [GuruDashboardController::class, 'showKalender'])->name('kalender.index');
    Route::resource('rapor', RaporController::class);
    Route::get('/rapor/{rapor}/pdf', [RaporController::class, 'generatePDF'])->name('rapor.pdf');
});

// ======= KEPALA SEKOLAH MODULES (Middleware Diperbarui) =======
Route::middleware(['auth:guru', 'is_kepala_sekolah'])->prefix('kepala-sekolah')->name('kepala-sekolah.')->group(function () {
    Route::get('izin', [KepalaSekolahIzinController::class, 'index'])->name('izin.index');
    Route::post('izin/{id}/approve', [KepalaSekolahIzinController::class, 'approve'])->name('izin.approve');
    Route::post('izin/{id}/reject', [KepalaSekolahIzinController::class, 'reject'])->name('izin.reject');
});

// ======= ADMIN AUTH =======
Route::prefix('auth')->group(function () {
    Route::get('/admin-login', [AdminAuthController::class, 'showLoginForm'])->name('auth.admin.login');
    Route::post('/admin-login', [AdminAuthController::class, 'login'])->name('auth.admin.login.submit');
    Route::post('/admin-logout', [AdminAuthController::class, 'logout'])->name('auth.admin.logout');
});

// ======= ADMIN DASHBOARD & MODULES (Middleware Diperbarui) =======
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('pendaftaran', AdminPendaftaranController::class)->only(['index', 'show', 'update']);
    Route::post('pendaftaran/approve-all', [AdminPendaftaranController::class, 'approveAll'])->name('pendaftaran.approveAll');
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::get('profil-sekolah', [ProfilSekolahController::class, 'index'])->name('profil-sekolah.index');
    Route::post('profil-sekolah', [ProfilSekolahController::class, 'store'])->name('profil-sekolah.store');
    Route::patch('profil-sekolah/{id}', [ProfilSekolahController::class, 'update'])->name('profil-sekolah.update');
    Route::prefix('master')->name('master.')->group(fn() => require __DIR__.'/master.php');
    Route::prefix('keuangan')->name('keuangan.')->group(fn() => require __DIR__.'/keuangan.php');
    Route::resource('peminjaman', PeminjamanController::class);
    Route::resource('kalender-sekolah', KalenderSekolahController::class);
    Route::resource('user-admin', UserAdminController::class);
    Route::resource('jam-pelajaran', JamPelajaranController::class);
});


// ======= HALAMAN STATIS =======
Route::get('/tentang-kami', [PageController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/visi-misi', [PageController::class, 'visiMisi'])->name('visi-misi');
Route::get('/jurusan', [PageController::class, 'jurusan'])->name('jurusan');
Route::get('/fasilitas', [PageController::class, 'fasilitas'])->name('fasilitas');
Route::get('/prestasi', [PageController::class, 'prestasi'])->name('prestasi');
Route::get('/mengapa-kami', [PageController::class, 'mengapaKami'])->name('mengapa-kami');
Route::get('/lisensi', [PageController::class, 'lisensi'])->name('lisensi');


// ======= BREEZE AUTH =======
require __DIR__.'/auth.php';

// Rute untuk menguji halaman error
Route::get('/test-error/{code?}', function ($code = 404) {
    abort($code);
});
