@extends('layouts.guru')

@section('title', 'Edit Materi')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Materi</h1>
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
            <form action="{{ route('guru.materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="judul">Judul Materi</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $materi->judul) }}" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="file">Unggah File (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="file" name="file" class="form-control-file">
                    @if($materi->file_path)
                        <small class="form-text text-muted">File saat ini: <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank">Lihat File</a></small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="mapel_id">Mata Pelajaran</label>
                    <select name="mapel_id" class="form-control" required>
                        @foreach($mapels as $mapel)
                            <option value="{{ $mapel->id }}" {{ old('mapel_id', $materi->mapel_id) == $mapel->id ? 'selected' : '' }}>
                                {{ $mapel->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>
                 <div class="form-group">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" class="form-control" required>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id', $materi->kelas_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select name="semester" class="form-control" required>
                        <option value="Ganjil" {{ old('semester', $materi->semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="Genap" {{ old('semester', $materi->semester) == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun_ajaran_id">Tahun Ajaran</label>
                    <select name="tahun_ajaran_id" class="form-control" required>
                        @foreach($tahunAjarans as $tahunAjaran)
                            <option value="{{ $tahunAjaran->id }}" {{ old('tahun_ajaran_id', $materi->tahun_ajaran_id) == $tahunAjaran->id ? 'selected' : '' }}>
                                {{ $tahunAjaran->tahun_ajaran }} - {{ $tahunAjaran->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $materi->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('guru.materi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

</div>
@endsection
