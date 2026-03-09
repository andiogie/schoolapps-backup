@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Jam Pelajaran</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.jam-pelajaran.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="urutan">Urutan</label>
                    <input type="number" name="urutan" id="urutan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="sesi">Label Sesi</label>
                    <input type="text" name="sesi" id="sesi" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <select name="tipe" id="tipe" class="form-control" required>
                        <option value="Pelajaran">Pelajaran</option>
                        <option value="Istirahat">Istirahat</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.jam-pelajaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
