@extends('layouts.siswa')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Tugas</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tugas untuk Kelas Anda</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Mata Pelajaran</th>
                            <th>Batas Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($tugas && $tugas->count() > 0)
                            @foreach ($tugas as $t)
                                @php
                                    $pengumpulan = null;
                                    // Gunakan nama relasi yang benar dari Model Tugas: pengumpulanTugas
                                    if ($t->pengumpulanTugas) {
                                        $pengumpulan = $t->pengumpulanTugas->where('siswa_id', Auth::guard('siswa')->id())->first();
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $t->judul }}</td>
                                    <td>{{ $t->mapel->nama_mapel }}</td>
                                    <td>{{ \Carbon\Carbon::parse($t->batas_waktu)->format('d M Y, H:i') }}</td>
                                    <td>
                                        @if ($pengumpulan && $pengumpulan->nilai !== null)
                                            <span class="badge bg-primary text-white">Sudah Dinilai: {{ $pengumpulan->nilai }}</span>
                                        @elseif ($pengumpulan)
                                            <span class="badge bg-success text-white">Sudah Dikumpulkan</span>
                                        @elseif (now()->gt($t->batas_waktu))
                                            <span class="badge bg-danger text-white">Terlambat</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Belum Dikumpulkan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('siswa.tugas.show', $t->id) }}" class="btn btn-sm btn-info shadow-sm">Lihat & Kumpulkan</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada tugas yang tersedia.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
