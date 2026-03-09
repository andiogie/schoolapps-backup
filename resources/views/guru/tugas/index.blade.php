@extends('layouts.guru')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Manajemen Tugas</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('guru.tugas.create') }}" class="btn btn-primary">Tambah Tugas</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Batas Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugas as $t)
                        <tr>
                            <td>{{ $t->id }}</td>
                            <td>{{ $t->judul }}</td>
                            <td>{{ $t->mapel->nama_mapel }}</td>
                            <td>{{ $t->kelas->nama_kelas }}</td>
                            <td>{{ \Carbon\Carbon::parse($t->batas_waktu)->format('d M Y, H:i') }}</td>
                            <td>
                                    <a href="{{ route('guru.tugas.show', $t->id) }}" class="btn btn-sm btn-info shadow-sm">Detail</a>
                                    <a href="{{ route('guru.tugas.edit', $t->id) }}" class="btn btn-sm btn-warning shadow-sm">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
