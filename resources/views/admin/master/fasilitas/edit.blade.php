@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Fasilitas</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.master.fasilitas.update', $fasilitas->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_fasilitas">Nama Fasilitas</label>
                            <input type="text" name="nama_fasilitas" class="form-control @error('nama_fasilitas') is-invalid @enderror" id="nama_fasilitas" placeholder="Masukkan Nama Fasilitas" value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}">
                            @error('nama_fasilitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_fasilitas">Deskripsi</label>
                            <textarea name="deskripsi_fasilitas" class="form-control @error('deskripsi_fasilitas') is-invalid @enderror" id="deskripsi_fasilitas" rows="3" placeholder="Masukkan Deskripsi Fasilitas">{{ old('deskripsi_fasilitas', $fasilitas->deskripsi_fasilitas) }}</textarea>
                            @error('deskripsi_fasilitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Gambar Fasilitas</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                            @if ($fasilitas->image)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($fasilitas->image) }}" alt="{{ $fasilitas->nama_fasilitas }}" width="150">
                                    <p class="text-muted">Gambar saat ini</p>
                                </div>
                            @endif
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" id="is_active">
                                <option value="1" {{ old('is_active', $fasilitas->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active', $fasilitas->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('admin.master.fasilitas.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
