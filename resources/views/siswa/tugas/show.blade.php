@extends('layouts.siswa')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail & Pengumpulan Tugas</h1>
        <a href="{{ route('siswa.tugas.index') }}" class="btn btn-secondary shadow-sm">Kembali ke Daftar Tugas</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <!-- Detail Tugas -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Tugas</h6>
                </div>
                <div class="card-body">
                    <h4 class="font-weight-bold">{{ $tugas->judul }}</h4>
                    <p class="text-muted">Mata Pelajaran: {{ $tugas->mapel->nama_mapel }}</p>
                    <hr>
                    <p><strong>Deskripsi:</strong></p>
                    <p>{{ $tugas->deskripsi }}</p>
                    <hr>
                    <p><strong>Batas Waktu:</strong> <span class="text-danger">{{ \Carbon\Carbon::parse($tugas->batas_waktu)->format('d M Y, H:i') }}</span></p>
                </div>
            </div>
        </div>

        <!-- Formulir Pengumpulan -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir Pengumpulan</h6>
                </div>
                <div class="card-body">
                    @if (now()->gt($tugas->batas_waktu) && !$pengumpulan)
                        <div class="alert alert-danger">
                            Batas waktu pengumpulan telah berakhir. Anda tidak dapat mengumpulkan tugas ini lagi.
                        </div>
                    @else
                        <form action="{{ route('siswa.tugas.store', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file_tugas" class="form-label">Upload File Tugas Anda</label>
                                <input class="form-control" type="file" id="file_tugas" name="file_tugas" required>
                                <small class="form-text text-muted">Format: PDF, DOC, DOCX, JPG, PNG. Maks: 2MB.</small>
                            </div>

                            @error('file_tugas')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary w-100">{{ $pengumpulan ? 'Kirim Ulang Tugas' : 'Kirim Tugas' }}</button>
                        </form>
                    @endif

                    @if ($pengumpulan)
                        <hr>
                        <div class="mt-4">
                            <h5>Status Pengumpulan:</h5>
                            <div class="card bg-light p-3">
                                <p><strong>Waktu Mengumpulkan:</strong> {{ \Carbon\Carbon::parse($pengumpulan->tanggal_pengumpulan)->format('d M Y, H:i') }}</p>
                                <p><strong>File Terkirim:</strong>
                                    <a href="{{ Storage::url($pengumpulan->file_path) }}" target="_blank">Lihat File</a>
                                </p>
                                <p><strong>Status Penilaian:</strong>
                                    @if($pengumpulan->nilai !== null)
                                        <span class="badge bg-success text-white">Sudah Dinilai</span>
                                    @else
                                        <span class="badge bg-info text-dark">Belum Dinilai</span>
                                    @endif
                                </p>
                                @if($pengumpulan->nilai !== null)
                                    <p class="font-weight-bold"><strong>Nilai: {{ $pengumpulan->nilai }}</strong></p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
