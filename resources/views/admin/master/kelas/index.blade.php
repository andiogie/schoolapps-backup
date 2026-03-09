@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Kelas</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.master.kelas.create') }}" class="btn btn-primary">Tambah Kelas</a>
            <form action="{{ route('admin.master.kelas.index') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" class="form-control" name="search" placeholder="Cari Nama Kelas..." value="{{ request('search') }}">
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kelas</th>
                            <th>Jurusan</th>
                            <th>Wali Kelas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelass as $kelas)
                            <tr>
                                <td>{{ $kelas->id }}</td>
                                <td>{{ $kelas->nama_kelas }}</td>
                                <td>{{ $kelas->jurusan->nama_jurusan ?? 'N/A' }}</td>
                                <td>
                                    {{ $kelas->waliKelas?->nama ?? 'Belum ada' }}
                                </td>
                                <td>
                                    @if($kelas->is_active)
                                        <span class="badge bg-success text-white">Aktif</span>
                                    @else
                                        <span class="badge bg-danger text-white">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.master.kelas.edit', $kelas->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data kelas ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $kelass->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
