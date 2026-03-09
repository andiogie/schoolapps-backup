@extends('layouts.admin')

@section('title', 'Tambah Kegiatan Baru')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Kegiatan Baru</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger text-white">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Content Row -->
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.kalender-sekolah.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tahun_ajaran_id">Tahun Ajaran</label>
                    <select id="tahun_ajaran_id" name="tahun_ajaran_id" class="form-control" required>
                        @foreach ($tahunAjarans as $tahunAjaran)
                            <option value="{{ $tahunAjaran->id }}">{{ $tahunAjaran->tahun_ajaran }} {{ $tahunAjaran->semester }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_kegiatan">Nama Kegiatan</label>
                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                <a href="{{ route('admin.kalender-sekolah.index') }}" class="btn btn-secondary btn-block mt-2">Batal</a>
            </form>
        </div>
    </div>

</div>
@endsection
