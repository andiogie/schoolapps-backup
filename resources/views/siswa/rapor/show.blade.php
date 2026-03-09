@extends('layouts.siswa')

@section('title', 'Rapor Akademik')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (isset($rapor) && $rapor)
                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end align-items-center mb-4">
                    <a href="{{ route('siswa.rapor.download') }}" target="_blank" class="btn btn-primary">
                        <i class="fas fa-print me-2"></i>Cetak / Unduh PDF
                    </a>
                </div>

                {{-- Area Pratinjau Rapor --}}
                <div id="rapor-preview-area">
                    {{-- KOP SURAT --}}
                    <div class="row align-items-center mb-4 border-bottom pb-3">
                        @if(isset($profilSekolah) && $profilSekolah->logo_path)
                            <div class="col-2 text-center">
                                <img src="{{ $profilSekolah->logo_path }}" alt="Logo Sekolah" style="max-height: 90px;">
                            </div>
                        @endif
                        <div class="{{ isset($profilSekolah) && $profilSekolah->logo_path ? 'col-10' : 'col-12' }} text-center">
                            <h3 class="fw-bold mb-1">LAPORAN HASIL BELAJAR SISWA</h3>
                            <h5 class="fw-semibold mb-1">{{ $profilSekolah->nama_sekolah ?? 'NAMA SEKOLAH BELUM DIATUR' }}</h5>
                            <p class="mb-0">Tahun Ajaran: {{ $rapor->tahunAjaran->tahun_ajaran }} - Semester {{ ucfirst($rapor->semester) }}</p>
                            @if(isset($profilSekolah))
                                <p class="text-muted small mb-0">{{ $profilSekolah->alamat ?? '' }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- INFO SISWA --}}
                    <div class="row mb-4">
                        <div class="col-md-6 mb-2"><span class="fw-bold d-block">Nama Siswa:</span> <span>{{ $rapor->siswa->nama }}</span></div>
                        <div class="col-md-6 mb-2"><span class="fw-bold d-block">Kelas:</span> <span>{{ $rapor->siswa->kelas->nama_kelas }}</span></div>
                        <div class="col-md-6 mb-2"><span class="fw-bold d-block">NIS:</span> <span>{{ $rapor->siswa->nis }}</span></div>
                        <div class="col-md-6 mb-2"><span class="fw-bold d-block">Wali Kelas:</span> <span>{{ $rapor->waliKelas->nama }}</span></div>
                    </div>

                    {{-- TABEL NILAI --}}
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th>Mata Pelajaran</th>
                                    <th class="text-center">Nilai Akhir</th>
                                    <th>Deskripsi/Capaian Kompetensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rapor->details as $index => $detail)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $detail->mapel->nama_mapel }}</td>
                                        <td class="text-center fw-bold fs-5">{{ $detail->nilai ?? ' - ' }}</td>
                                        <td>{{ $detail->deskripsi ?? ' - ' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center py-5">Belum ada data nilai.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- Ringkasan Akademik --}}
                    <div class="row justify-content-end mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Ringkasan Akademik</h5>
                                    <table class="table table-sm table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="fw-semibold">Nilai Rata-rata</td>
                                                <td class="text-end fw-bold fs-5">{{ $rapor->nilai_rata_rata }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Status Akademik</td>
                                                <td class="text-end fw-bold fs-5 text-primary">{{ $rapor->status_akademik }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CATATAN WALI KELAS --}}
                    <div class="mt-4">
                        <h5 class="fw-bold">Catatan Wali Kelas:</h5>
                        <div class="card bg-light">
                            <div class="card-body">
                                <p class="mb-0 fst-italic">{{ $rapor->catatan_wali_kelas ?? 'Tidak ada catatan.' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- TANDA TANGAN (Ditambahkan untuk konsistensi) --}}
                    <div class="row mt-5 pt-3">
                        <div class="col-6 text-center">
                            <p class="mb-5">Mengetahui,</p>
                            <p class="fw-bold mb-0">{{ $profilSekolah->nama_kepala_sekolah ?? '.........................' }}</p>
                            <hr style="width: 70%; margin: auto;">
                            <p>Kepala Sekolah</p>
                        </div>
                        <div class="col-6 text-center">
                            <p class="mb-5">Wali Kelas,</p>
                            <p class="fw-bold mb-0">{{ $rapor->waliKelas->nama }}</p>
                            <hr style="width: 70%; margin: auto;">
                            <p>NIP: {{ $rapor->waliKelas->nip ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @else
                {{-- Pesan jika rapor tidak ditemukan --}}
                <div class="alert alert-warning text-center" role="alert">
                    @if(isset($error))
                        <i class="fas fa-info-circle me-2"></i> {{ $error }}
                    @else
                        <i class="fas fa-info-circle me-2"></i>
                        Data rapor untuk semester ini belum tersedia. Silakan hubungi wali kelas Anda.
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush
