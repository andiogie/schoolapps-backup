@extends('layouts.guru')

@section('title', 'Buat Pengajuan Izin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Buat Pengajuan Izin</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Pengajuan Izin</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('guru.izin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="jenis_izin">Jenis Izin</label>
                    <select class="form-control" id="jenis_izin" name="jenis_izin" required>
                        <option value="">Pilih Jenis Izin...</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Cuti">Cuti</option>
                        <option value="Izin Khusus">Izin Khusus</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alasan">Alasan</label>
                    <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="file_pendukung">File Pendukung (Opsional)</label>
                    <input type="file" class="form-control-file" id="file_pendukung" name="file_pendukung">
                    <small class="form-text text-muted">Contoh: Surat dokter. Maksimal 2MB (JPG, PNG, PDF).</small>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                <a href="{{ route('guru.izin.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection