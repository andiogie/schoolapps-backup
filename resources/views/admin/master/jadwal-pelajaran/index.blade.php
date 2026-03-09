@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Jadwal Pelajaran</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.master.jadwal-pelajaran.create') }}" class="btn btn-primary">Tambah Jadwal Pelajaran</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tahun Ajaran</th>
                            <th>Kelas</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwals as $jadwal)
                            <tr>
                                <td>{{ $jadwal->tahunAjaran?->tahun_ajaran ?? 'Data Hilang' }}</td>
                                <td>{{ $jadwal->kelas?->nama_kelas ?? 'Data Hilang' }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>
                                    {{ $jadwal->jam_mulai ? date('H:i', strtotime($jadwal->jam_mulai)) : '--:--' }} - {{ $jadwal->jam_selesai ? date('H:i', strtotime($jadwal->jam_selesai)) : '--:--' }}
                                </td>
                                <td>{{ $jadwal->mapel?->nama_mapel ?? 'Data Hilang' }}</td>
                                <td>{{ $jadwal->guru?->nama ?? 'Data Hilang' }}</td>
                                <td>
                                    <a href="{{ route('admin.master.jadwal-pelajaran.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.master.jadwal-pelajaran.destroy', ['jadwal_pelajaran' => $jadwal->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data jadwal pelajaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $jadwals->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
