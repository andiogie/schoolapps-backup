@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Guru</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('admin.master.guru.create') }}" class="btn btn-primary btn-sm">Tambah Guru</a>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#uploadGuruModal">
                    Upload Data Guru
                </button>
            </div>
            <form action="{{ route('admin.master.guru.index') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" class="form-control" name="search" placeholder="Cari Nama/NIP..." value="{{ request('search') }}">
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
                            <th>NIP</th>
                            <th>Nama Guru</th>
                            <th>Email</th>
                            <th>Mata Pelajaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gurus as $guru)
                            <tr>
                                <td>{{ $guru->id }}</td>
                                <td>{{ $guru->nip }}</td>
                                <td>{{ $guru->nama }}</td>
                                <td>{{ $guru->email }}</td>
                                <td>{{ $guru->mapel->nama_mapel ?? 'Tidak ada' }}</td>
                                <td>
                                    @if ($guru->is_active)
                                        <span class="badge bg-success text-white">Aktif</span>
                                    @else
                                        <span class="badge bg-danger text-white">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('admin.master.guru.edit', $guru->id) }}" class="btn btn-warning btn-sm mr-2">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data guru ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $gurus->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Guru Modal -->
<div class="modal fade" id="uploadGuruModal" tabindex="-1" aria-labelledby="uploadGuruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.master.guru.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadGuruModalLabel">Upload File CSV Data Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih File CSV:</label>
                        <input class="form-control" type="file" id="file" name="file" accept=".csv,.txt" required>
                        <div class="form-text">File harus berformat .csv dengan header: <strong>nama,nip,email,mapel_id</strong>.</div>
                    </div>
                    <p>Unduh <a href="{{ asset('contoh_import_guru.csv') }}" download>template file CSV</a> jika Anda belum memilikinya.</p>
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
