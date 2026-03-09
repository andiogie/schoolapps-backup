@extends('layouts.siswa')

@section('title', 'Materi Pelajaran')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Materi Pelajaran</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Materi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Judul Materi</th>
                                    <th>Mapel</th>
                                    <th>Guru</th>
                                    <th style="width: 15%;">Tgl. Upload</th>
                                    <th style="width: 12%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($materis as $materi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $materi->judul }}</td>
                                        <td>{{ $materi->mapel->nama }}</td>
                                        <td>{{ $materi->guru->nama }}</td>
                                        <td>{{ $materi->created_at->format('d M Y') }}</td>
                                        <td>
                                            {{-- Kembali ke tautan unduhan sederhana yang andal --}}
                                            <a href="{{ route('siswa.materi.download', $materi->id) }}" class="btn btn-primary btn-sm" target="_blank">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada materi yang tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

{{-- Tidak ada lagi iframe atau script rumit, hanya HTML bersih --}}
