@extends('layouts.admin')
@section('title', 'Daftar Pembayaran SPP')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <style>
        /* Custom styles for responsiveness */
        .table-responsive {
            overflow-x: auto;
        }
    </style>
@endpush
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Pembayaran SPP</h1>

    <!-- Card Data Pembayaran -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.keuangan.pembayaran.create') }}" class="btn btn-primary">Catat Pembayaran</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable-pembayaran" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Bayar</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Tahun Ajaran</th>
                            <th>SPP Bulan & Tahun</th>
                            <th>Jumlah Bayar</th>
                            <th>Tipe</th>
                            <th>Dicatat Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pembayarans as $pembayaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d-m-Y') }}</td>
                                <td>{{ $pembayaran->siswa?->nama_siswa ?? '-' }}</td>
                                <td>{{ $pembayaran->siswa?->nis ?? '-' }}</td>
                                <td>{{ ($pembayaran->tahunAjaran?->tahun_ajaran ?? 'N/A') . ' - ' . ($pembayaran->tahunAjaran?->semester ?? '') }}</td>
                                <td>{{ \Carbon\Carbon::create()->month($pembayaran->bulan_spp)->format('F') }} {{ $pembayaran->tahun_spp }}</td>
                                <td>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        $badgeClass = 'badge bg-secondary';
                                        if ($pembayaran->tipe_pembayaran == 'Cash') $badgeClass = 'badge bg-success';
                                        elseif ($pembayaran->tipe_pembayaran == 'QRIS') $badgeClass = 'badge bg-primary';
                                        elseif ($pembayaran->tipe_pembayaran == 'Transfer') $badgeClass = 'badge bg-info';
                                    @endphp
                                    <span class="{{ $badgeClass }}">{{ $pembayaran->tipe_pembayaran }}</span>
                                </td>
                                <td>{{ $pembayaran->user?->nama ?? 'Admin Terhapus' }}</td>
                                <td>
                                    <a href="{{ route('admin.keuangan.pembayaran.edit', $pembayaran->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Belum ada data pembayaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script>
$(document).ready(function() {
    @if($pembayarans->count() > 0)
        new DataTable('#datatable-pembayaran');
    @endif
});
</script>
@endpush
