@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Manajemen Jam Pelajaran</h1>
    <p class="mb-4">Halaman ini digunakan untuk mengelola template jam pelajaran yang akan digunakan di seluruh sistem.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.jam-pelajaran.create') }}" class="btn btn-primary btn-sm">Tambah Jam Pelajaran</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Label Sesi</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Tipe</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jamPelajarans as $jam)
                            <tr>
                                <td>{{ $jam->urutan }}</td>
                                <td>{{ $jam->sesi }}</td>
                                <td>{{ $jam->waktu_mulai }}</td>
                                <td>{{ $jam->waktu_selesai }}</td>
                                <td>{{ $jam->tipe }}</td>
                                <td>
                                    <a href="{{ route('admin.jam-pelajaran.edit', $jam->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.jam-pelajaran.destroy', $jam->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data jam pelajaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
