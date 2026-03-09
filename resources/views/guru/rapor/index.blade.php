@extends('layouts.guru')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Input Rapor Siswa</h1>
    <p class="mb-4">Pilih siswa dari kelas yang Anda ampu untuk mulai mengisi, mengedit, atau melihat rapor.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa Kelas {{ auth()->user()->kelas->nama_kelas ?? '' }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($siswas->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada siswa yang terdaftar di kelas ini.</td>
                            </tr>
                        @else
                            @foreach ($siswas as $siswa)
                                <tr>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('guru.rapor.edit', $siswa->id) }}" class="btn btn-primary btn-sm">Isi / Edit Rapor</a>
                                        <a href="{{ route('guru.rapor.show', $siswa->id) }}" class="btn btn-info btn-sm">Lihat Rapor</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
