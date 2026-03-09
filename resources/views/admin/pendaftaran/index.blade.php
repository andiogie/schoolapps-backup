@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Pendaftar</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <form action="{{ route('admin.pendaftaran.index') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" class="form-control" name="search" placeholder="Cari Nama Pendaftar..." value="{{ request('search') }}">
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            <form action="{{ route('admin.pendaftaran.approveAll') }}" method="POST" id="approve-all-form">
                @csrf
                <button type="button" class="btn btn-success" id="approve-all-btn" onclick="confirmAndProcessApproval()">
                    Approve Semua Pending
                </button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Pendaftaran</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Jurusan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendaftarans as $pendaftaran)
                            <tr>
                                <td>{{ $pendaftaran->no_pendaftaran }}</td>
                                <td>{{ $pendaftaran->nama_lengkap }}</td>
                                <td>{{ $pendaftaran->email }}</td>
                                <td>{{ optional($pendaftaran->jurusanRelasi)->nama_jurusan ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $statusClass = '';
                                        switch ($pendaftaran->status) {
                                            case 'pending':
                                                $statusClass = 'bg-info';
                                                break;
                                            case 'verified':
                                                $statusClass = 'bg-success';
                                                break;
                                            case 'rejected':
                                                $statusClass = 'bg-danger';
                                                break;
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }} text-white">{{ ucfirst($pendaftaran->status) }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}" class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data pendaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $pendaftarans->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmAndProcessApproval() {
    if (confirm('Apakah Anda yakin ingin menyetujui semua pendaftar dengan status \'pending\'? Tindakan ini akan mengubah status mereka menjadi \'verified\'. Proses ini tidak dapat diurungkan.')) {
        // Dapatkan elemen tombol dan form
        const button = document.getElementById('approve-all-btn');
        const form = document.getElementById('approve-all-form');

        // Nonaktifkan tombol untuk mencegah klik ganda
        button.disabled = true;

        // Ubah teks tombol dan tambahkan spinner
        button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...';

        // Kirim form
        form.submit();
    }
}
</script>
@endpush
