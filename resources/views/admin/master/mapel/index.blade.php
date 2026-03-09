@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Mata Pelajaran</h1>
    <p class="mb-4">Daftar semua mata pelajaran yang terdaftar dalam sistem.</p>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center">
            <div class="mb-2 mb-md-0">
                <a href="{{ route('admin.master.mapel.create') }}" class="btn btn-primary btn-sm">Tambah Mata Pelajaran</a>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#uploadMapelModal">
                    Upload Data Mapel
                </button>
            </div>
            <form action="{{ route('admin.master.mapel.index') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" class="form-control" name="search" placeholder="Cari Nama/Kode..." value="{{ request('search') }}">
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
                            <th>Kode Mapel</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mapels as $mapel)
                        <tr>
                            <td>{{ $mapel->id }}</td>
                            <td>{{ $mapel->kode_mapel }}</td>
                            <td>{{ $mapel->nama_mapel }}</td>
                            <td>
                                @if($mapel->is_active)
                                    <span class="badge bg-success text-white">Aktif</span>
                                @else
                                    <span class="badge bg-danger text-white">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.master.mapel.edit', $mapel->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data mata pelajaran ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $mapels->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Upload Mapel -->
<div class="modal fade" id="uploadMapelModal" tabindex="-1" aria-labelledby="uploadMapelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.master.mapel.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadMapelModalLabel">Upload File CSV Data Mata Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih File CSV:</label>
                        <input class="form-control" type="file" id="file" name="file" accept=".csv,.txt" required>
                        <div class="form-text">File harus berformat .csv dengan header: <strong>kode_mapel,nama_mapel</strong>.</div>
                    </div>
                    <p>Unduh <a href="{{ asset('contoh_import_mapel.csv') }}" download>template file CSV</a> jika Anda belum memilikinya.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
