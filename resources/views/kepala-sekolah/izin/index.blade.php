@extends('layouts.guru')

@section('title', 'Persetujuan Pengajuan Izin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Persetujuan Pengajuan Izin</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan Izin</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Guru</th>
                            <th>Tanggal Izin</th>
                            <th>Jenis Izin</th>
                            <th>Alasan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($daftarIzin as $izin)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $izin->guru->nama ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($izin->tanggal_selesai)->format('d M Y') }}</td>
                                <td>{{ $izin->jenis_izin }}</td>
                                <td>{{ $izin->alasan }}</td>
                                <td>
                                    <span class="badge 
                                        @if($izin->status == 'Disetujui') bg-success text-white 
                                        @elseif($izin->status == 'Ditolak') bg-danger text-white 
                                        @else bg-warning text-white @endif">
                                        {{ $izin->status }}
                                    </span>
                                </td>
                                <td>
                                    @if ($izin->status == 'Diajukan')
                                        <form action="{{ route('kepala-sekolah.izin.approve', $izin->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                        </form>
                                        <form action="{{ route('kepala-sekolah.izin.reject', $izin->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                        </form>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data pengajuan izin.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection