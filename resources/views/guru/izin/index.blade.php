@extends('layouts.guru')

@section('title', 'Pengajuan Izin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Pengajuan Izin</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('guru.izin.create') }}" class="btn btn-primary">Ajukan Izin</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <th>Jenis Izin</th>
                            <th>Tanggal Izin</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayatIzin as $izin)
                            <tr>
                                <td>{{ $izin->created_at->format('d M Y') }}</td>
                                <td>{{ $izin->jenis_izin }}</td>
                                <td>{{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($izin->tanggal_selesai)->format('d M Y') }}</td>
                                <td>
                                    @if ($izin->status == 'Disetujui')
                                        <span class="badge bg-success text-white">Disetujui</span>
                                    @elseif ($izin->status == 'Ditolak')
                                        <span class="badge bg-danger text-white">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-white">Diajukan</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada riwayat pengajuan izin.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection