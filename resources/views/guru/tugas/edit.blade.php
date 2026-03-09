@extends('layouts.guru')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Tugas</h1>
        <a href="{{ route('guru.tugas.index') }}" class="btn btn-secondary shadow-sm">Kembali</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Tugas</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('guru.tugas.update', $tuga->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Tugas</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $tuga->judul) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $tuga->deskripsi) }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kelas_id" class="form-label">Kelas</label>
                                <select class="form-select" id="kelas_id" name="kelas_id" required>
                                    @foreach ($kelas as $kls)
                                        <option value="{{ $kls->id }}" {{ $tuga->kelas_id == $kls->id ? 'selected' : '' }}>{{ $kls->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mapel_id" class="form-label">Mata Pelajaran</label>
                                <select class="form-select" id="mapel_id" name="mapel_id" required>
                                    @foreach ($mapel as $mpl)
                                        <option value="{{ $mpl->id }}" {{ $tuga->mapel_id == $mpl->id ? 'selected' : '' }}>{{ $mpl->nama_mapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="batas_waktu" class="form-label">Batas Waktu</label>
                            <input type="datetime-local" class="form-control" id="batas_waktu" name="batas_waktu" value="{{ old('batas_waktu', \Carbon\Carbon::parse($tuga->batas_waktu)->format('Y-m-d\TH:i')) }}" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
