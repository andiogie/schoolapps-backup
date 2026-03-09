@extends('layouts.guru')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Manajemen Materi</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('guru.materi.create') }}" class="btn btn-primary">Tambah Materi</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Mata Pelajaran</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($materis->count() > 0)
                            @foreach($materis as $key => $materi)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $materi->judul }}</td>
                                    <td>{{ $materi->mapel->nama_mapel ?? 'N/A' }}</td>
                                    <td>{{ $materi->semester }}</td>
                                    <td>{{ $materi->tahunAjaran->tahun_ajaran ?? 'N/A' }} - {{ $materi->tahunAjaran->semester ?? '' }}</td>
                                    <td>
                                        @if($materi->is_active)
                                            <span class="badge bg-success text-white">Aktif</span>
                                        @else
                                            <span class="badge bg-danger text-white">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('guru.materi.edit', $materi->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">Belum ada materi yang ditambahkan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
