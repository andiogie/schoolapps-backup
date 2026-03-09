@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Mata Pelajaran</h1>
    <p class="mb-4">Buat mata pelajaran baru.</p>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.master.mapel.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kode_mapel">Kode Mapel</label>
                    <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" placeholder="Contoh: MTK-01" value="{{ old('kode_mapel') }}" required>
                </div>
                <div class="form-group">
                    <label for="nama_mapel">Nama Mata Pelajaran</label>
                    <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" placeholder="Contoh: Matematika Wajib" value="{{ old('nama_mapel') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.master.mapel.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

</div>
@endsection
