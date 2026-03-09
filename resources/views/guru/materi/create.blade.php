@extends('layouts.guru')

@section('title', 'Tambah Materi Baru')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Materi Baru</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
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
            <form action="{{ route('guru.materi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="judul">Judul Materi</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="file">Unggah File</label>
                    <input type="file" name="file" class="form-control-file" required>
                </div>
                <div class="form-group">
                    <label for="mapel_id">Mata Pelajaran</label>
                    <select name="mapel_id" class="form-control" required>
                        <option value="" disabled selected>Pilih Mata Pelajaran</option>
                        @foreach($mapels as $mapel)
                            <option value="{{ $mapel->id }}" {{ old('mapel_id') == $mapel->id ? 'selected' : '' }}>{{ $mapel->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" class="form-control" required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select name="semester" class="form-control" required>
                        <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun_ajaran_id">Tahun Ajaran</label>
                    <select name="tahun_ajaran_id" class="form-control" required>
                        <option value="" disabled selected>Pilih Tahun Ajaran</option>
                       @foreach ($tahunAjarans as $tahunAjaran)
                           <option value="{{ $tahunAjaran->id }}" {{ old('tahun_ajaran_id') == $tahunAjaran->id ? 'selected' : '' }}>
                               {{ $tahunAjaran->tahun_ajaran }} - {{ $tahunAjaran->semester }}
                           </option>
                       @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                <a href="{{ route('guru.materi.index') }}" class="btn btn-secondary btn-block mt-2">Batal</a>
            </form>
        </div>
    </div>

</div>
@endsection
