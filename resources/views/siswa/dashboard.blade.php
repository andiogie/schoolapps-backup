@extends('layouts.siswa')

@section('title', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">assignment</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Jumlah Tugas</p>
                    <h4 class="mb-0">{{ $jumlahTugas ?? 'N/A' }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Segera kerjakan!</span></p>
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
                    <p class="text-sm mb-0 text-capitalize">Materi Pelajaran</p>
                    <h4 class="mb-0">{{ $jumlahMateri ?? 'N/A' }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Baca dan pelajari.</span></p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">checklist</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Kehadiran</p>
                    <h4 class="mb-0">{{ $jumlahKehadiran ?? 'N/A' }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">Jangan bolos!</span></p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">receipt_long</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Lihat Rapor</p>
                    <h4 class="mb-0"><a href="{{ route('siswa.rapor.show') }}">Klik di sini</a></h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-info text-sm font-weight-bolder">Periksa nilaimu.</span></p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Tugas Terbaru</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-check text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">5 tugas</span> terakhir
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tugas</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mapel</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Guru</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tenggat</th>
                            </tr>
                        </thead>
                        <tbody>
                             @forelse ($tugasTerbaru as $tugas)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><a href="{{ route('siswa.tugas.show', $tugas->id) }}">{{ Str::limit($tugas->judul, 35) }}</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">{{ optional($tugas->mapel)->nama_mapel }}</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">{{ optional($tugas->guru)->nama }}</span>
                                    </td>
                                     <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-danger">{{ \Carbon\Carbon::parse($tugas->tenggat_waktu)->format('d M Y') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Hore! Tidak ada tugas baru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0">
                <h6>Selamat Datang, {{ $siswa->nama }}!</h6>
            </div>
            <div class="card-body p-3">
                @if ($siswa->kelas)
                    <p class="card-text">
                        Berikut adalah detail informasi Anda terkait kelas dan wali kelas.
                    </p>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <strong>Kelas:</strong>
                            <p>{{ $siswa->kelas->nama_kelas ?? 'Data tidak ditemukan' }}</p>
                        </div>
                        <div class="col-md-12">
                            <strong>Jurusan:</strong>
                            <p>{{ optional($siswa->kelas->jurusan)->nama_jurusan ?? 'Data tidak ditemukan' }}</p>
                        </div>
                        <div class="col-md-12">
                            <strong>Wali Kelas:</strong>
                            <p>{{ optional($siswa->kelas->waliKelas)->nama ?? 'Belum ditentukan' }}</p>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning text-white" role="alert">
                        <strong>Perhatian!</strong> Anda saat ini belum terdaftar di kelas manapun. Silakan hubungi administrasi.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
