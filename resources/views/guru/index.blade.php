@extends('layouts.guru')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">class</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Jumlah Kelas</p>
                    {{-- Ganti dengan data dinamis --}}
                    <h4 class="mb-0">5</h4> 
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>Kelas yang Anda ajar</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">book_online</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Jumlah Materi</p>
                    {{-- Ganti dengan data dinamis --}}
                    <h4 class="mb-0">23</h4> 
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>Materi yang diupload</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">assignment</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Jumlah Tugas</p>
                    {{-- Ganti dengan data dinamis --}}
                    <h4 class="mb-0">12</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"></span>Tugas yang diberikan</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Siswa</p>
                    {{-- Ganti dengan data dinamis --}}
                    <h4 class="mb-0">150</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>Total siswa Anda</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header pb-0">
                <h6 class="font-weight-bolder">Selamat Datang, {{ Auth::user()->name }}!</h6>
            </div>
            <div class="card-body">
                <p>Selamat datang di dasbor Guru. Ini adalah pusat kendali Anda untuk mengelola semua aktivitas mengajar.</p>
                <p>Gunakan menu navigasi di sebelah kiri untuk:</p>
                <ul>
                    <li>Mengupload dan mengelola <strong>Materi</strong> pelajaran.</li>
                    <li>Memberikan dan menilai <strong>Tugas</strong> untuk siswa.</li>
                    <li>Mencatat <strong>Absensi</strong> kehadiran siswa di setiap kelas.</li>
                    <li>Mengelola dan mempublikasikan <strong>Rapor</strong> siswa.</li>
                </ul>
                <p>Manfaatkan semua fitur yang ada untuk menciptakan pengalaman belajar yang lebih efisien dan terorganisir. Semangat mengajar!</p>
            </div>
        </div>
    </div>
</div>
@endsection
