@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Jam Pelajaran</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger text-white">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.jam-pelajaran.update', $jamPelajaran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="urutan">Urutan</label>
                    <input type="number" name="urutan" id="urutan" class="form-control" value="{{ old('urutan', $jamPelajaran->urutan) }}" required>
                </div>
                <div class="form-group">
                    <label for="sesi">Label Sesi</label>
                    <input type="text" name="sesi" id="sesi" class="form-control" value="{{ old('sesi', $jamPelajaran->sesi) }}" required>
                </div>
                <div class="form-group">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" value="{{ old('waktu_mulai', $jamPelajaran->waktu_mulai) }}" required>
                </div>
                <div class="form-group">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" value="{{ old('waktu_selesai', $jamPelajaran->waktu_selesai) }}" required>
                </div>
                <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <select name="tipe" id="tipe" class="form-control" required>
                        <option value="Pelajaran" {{ old('tipe', $jamPelajaran->tipe) == 'Pelajaran' ? 'selected' : '' }}>Pelajaran</option>
                        <option value="Istirahat" {{ old('tipe', $jamPelajaran->tipe) == 'Istirahat' ? 'selected' : '' }}>Istirahat</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.jam-pelajaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
