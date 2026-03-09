@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Kalender Sekolah</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.kalender-sekolah.create') }}" class="btn btn-primary">Tambah Kegiatan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Kegiatan</th>
                            <th>Tahun Ajaran</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kalenderSekolah as $kegiatan)
                        <tr>
                            <td>{{ $kegiatan->nama_kegiatan }}</td>
                            <td>{{ $kegiatan->tahunAjaran->tahun_ajaran }} {{ $kegiatan->tahunAjaran->semester }}</td>
                            <td>{{ $kegiatan->tanggal_mulai }}</td>
                            <td>{{ $kegiatan->tanggal_selesai }}</td>
                            <td>
                                @if($kegiatan->is_active)
                                    <span class="badge bg-success text-white">Aktif</span>
                                @else
                                    <span class="badge bg-danger text-white">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.kalender-sekolah.edit', $kegiatan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $kalenderSekolah->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
