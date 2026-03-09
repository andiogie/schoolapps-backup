@extends('layouts.admin')

@section('title', 'Tambah Siswa dari Pendaftar')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Siswa dari Pendaftar</h1>
        <a href="{{ route('admin.master.siswa.index') }}" class="btn btn-sm btn-secondary shadow-sm">Kembali</a>
    </div>

    {{-- PERBAIKAN: Menampilkan error umum jika ada, untuk debug --}}
    @if ($errors->any() && !app()->environment('production'))
        <div class="alert alert-danger border-left-danger" role="alert">
            <h6 class="font-weight-bold">Error Validasi Terdeteksi:</h6>
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM PENCARIAN PENDAFTAR --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">1. Cari Pendaftar (Status: Terverifikasi)</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.master.siswa.create') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Ketik nama atau email pendaftar..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>

            @if(isset($pendaftars))
                 @if($pendaftars->count() > 0)
                    <ul class="list-group mt-3">
                        @foreach ($pendaftars as $pendaftar)
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6>{{ $pendaftar->nama_lengkap }}</h6>
                                    <small>Email: {{ $pendaftar->email }} | Jurusan: {{ $pendaftar->jurusanRelasi->nama_jurusan ?? 'N/A' }}</small>
                                </div>
                                <a href="{{ route('admin.master.siswa.create', ['pendaftaran_id' => $pendaftar->id, 'search' => request('search')]) }}" class="btn btn-sm btn-success">Pilih</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="mt-3 text-center">Pendaftar tidak ditemukan, statusnya bukan 'verified', atau sudah terdaftar sebagai siswa.</p>
                @endif
            @endif
        </div>
    </div>

    {{-- FORM UTAMA TAMBAH SISWA --}}
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">2. Detail Siswa</h6>
        </div>
        <div class="card-body">
            {{-- PERBAIKAN: Jika pendaftar belum dipilih, tampilkan pesan --}}
            @if(!$selectedPendaftar)
                <div class="text-center">
                    <p class="font-weight-bold">Silakan cari dan pilih pendaftar di atas terlebih dahulu.</p>
                </div>
            @else
                <form action="{{ route('admin.master.siswa.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pendaftaran_id" value="{{ $selectedPendaftar->id ?? '' }}">

                    <fieldset disabled>
                         <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{ $selectedPendaftar->nama_lengkap ?? '' }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" value="{{ $selectedPendaftar->email ?? '' }}">
                            </div>
                             <div class="col-md-6 form-group">
                                <label>Jurusan Pilihan</label>
                                <input type="text" class="form-control" value="{{ $selectedPendaftar->jurusanRelasi->nama_jurusan ?? '' }}">
                            </div>
                             <div class="col-md-6 form-group">
                                <label>Asal Sekolah</label>
                                <input type="text" class="form-control" value="{{ $selectedPendaftar->asal_sekolah ?? '' }}">
                            </div>
                        </div>
                    </fieldset>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="nis">NIS <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" id="nis" value="{{ old('nis') }}" required>
                            @error('nis')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="kelas_id">Tempatkan di Kelas <span class="text-danger">*</span></label>
                            <select name="kelas_id" id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($kelases as $kelas)
                                    <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                             @error('kelas_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="password">Password Login <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Simpan dan Buat Akun Siswa</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
