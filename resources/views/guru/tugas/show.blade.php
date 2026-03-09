@extends('layouts.guru')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Tugas</h1>
        <a href="{{ route('guru.tugas.index') }}" class="btn btn-secondary shadow-sm">Kembali</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $tuga->judul }}</h6>
                </div>
                <div class="card-body">
                    <p><strong>Mata Pelajaran:</strong> {{ $tuga->mapel->nama_mapel }}</p>
                    <p><strong>Kelas:</strong> {{ $tuga->kelas->nama_kelas }}</p>
                    <p><strong>Batas Waktu:</strong> {{ \Carbon\Carbon::parse($tuga->batas_waktu)->format('d M Y, H:i') }}</p>
                    <hr>
                    <p><strong>Deskripsi:</strong></p>
                    <p>{{ $tuga->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa yang Mengumpulkan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Waktu Pengumpulan</th>
                                    <th>File Tugas</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tuga->pengumpulanTugas as $pengumpulan)
                                    <tr>
                                        <td>{{ $pengumpulan->siswa->nama_siswa }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pengumpulan->created_at)->format('d M Y, H:i') }}</td>
                                        <td>
                                            @if ($pengumpulan->file_path)
                                                <a href="{{ Storage::url($pengumpulan->file_path) }}" target="_blank" class="btn btn-sm btn-info">Lihat File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $pengumpulan->nilai ?? 'Belum dinilai' }}</td>
                                        <td>
                                            <form action="{{ route('guru.penilaian.update', $pengumpulan->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="input-group">
                                                    <input type="number" name="nilai" class="form-control" placeholder="Beri nilai" min="0" max="100" value="{{ $pengumpulan->nilai }}">
                                                    <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada siswa yang mengumpulkan tugas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
