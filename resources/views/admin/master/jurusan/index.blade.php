@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Jurusan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.master.jurusan.create') }}" class="btn btn-primary">Tambah Jurusan</a>
            <form action="{{ route('admin.master.jurusan.index') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" class="form-control" name="search" placeholder="Cari Jurusan..." value="{{ request('search') }}">
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
                            <th>Nama Jurusan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jurusans as $jurusan)
                        <tr>
                            <td>{{ $jurusan->id }}</td>
                            <td>{{ $jurusan->nama_jurusan }}</td>
                            <td>
                                @if($jurusan->is_active)
                                    <span class="badge bg-success text-white">Aktif</span>
                                @else
                                    <span class="badge bg-danger text-white">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.master.jurusan.edit', $jurusan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $jurusans->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
