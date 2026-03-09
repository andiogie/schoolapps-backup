@extends('layouts.siswa')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Riwayat Absensi</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="{{ route('siswa.absensi.riwayat') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <label for="periode" class="mr-2">Pilih Periode:</label>
                    <input type="month" id="periode" name="periode" class="form-control" value="{{ $periode }}">
                </div>
                <button type="submit" class="btn btn-primary">Tampilkan</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Status</th>
                            <th>Lokasi Masuk</th>
                            <th>Lokasi Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatAbsensi as $absensi)
                            @php
                                $date = \Carbon\Carbon::parse($absensi->tanggal);
                                $englishDay = $date->format('l');
                                $hariMap = [
                                    'Sunday' => 'Minggu',
                                    'Monday' => 'Senin',
                                    'Tuesday' => 'Selasa',
                                    'Wednesday' => 'Rabu',
                                    'Thursday' => 'Kamis',
                                    'Friday' => 'Jumat',
                                    'Saturday' => 'Sabtu',
                                ];
                                $indonesianDay = $hariMap[$englishDay] ?? $englishDay;
                                $formattedDate = $indonesianDay . ', ' . $date->isoFormat('D MMMM YYYY');
                            @endphp
                            <tr>
                                <td>{{ $formattedDate }}</td>
                                <td>{{ $absensi->waktu_masuk ? \Carbon\Carbon::parse($absensi->waktu_masuk)->format('H:i:s') : '-' }}</td>
                                <td>{{ $absensi->waktu_keluar ? \Carbon\Carbon::parse($absensi->waktu_keluar)->format('H:i:s') : '-' }}</td>
                                <td>
                                    @if($absensi->status == 'Hadir')
                                        <span class="badge bg-success text-white">Hadir</span>
                                    @elseif($absensi->status == 'Tidak Hadir')
                                        <span class="badge bg-danger text-white">Tidak Hadir</span>
                                    @else
                                        <span class="badge bg-secondary text-white">Akhir Pekan</span>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($absensi->latitude_masuk) && isset($absensi->longitude_masuk))
                                        <a href="https://www.google.com/maps?q={{ $absensi->latitude_masuk }},{{ $absensi->longitude_masuk }}" target="_blank" class="btn btn-sm btn-info">Lihat Lokasi</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if(isset($absensi->latitude_keluar) && isset($absensi->longitude_keluar))
                                        <a href="https://www.google.com/maps?q={{ $absensi->latitude_keluar }},{{ $absensi->longitude_keluar }}" target="_blank" class="btn btn-sm btn-info">Lihat Lokasi</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data absensi untuk periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
