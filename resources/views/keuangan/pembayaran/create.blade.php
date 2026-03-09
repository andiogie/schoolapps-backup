@extends('layouts.admin')

@section('title', 'Catat Pembayaran SPP')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Catat Pembayaran SPP</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM PENCARIAN SISWA --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">1. Cari Siswa</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.keuangan.pembayaran.create') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Ketik Nama atau NIS siswa..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>

            {{-- HASIL PENCARIAN --}}
            @if(isset($siswas))
                @if($siswas->count() > 0)
                    <ul class="list-group mt-3">
                        @foreach ($siswas as $siswa)
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6>{{ $siswa->nama_siswa }}</h6>
                                    <small>NIS: {{ $siswa->nis }} | Kelas: {{ $siswa->kelas->nama_kelas }}</small>
                                </div>
                                <a href="{{ route('admin.keuangan.pembayaran.create', ['siswa_id' => $siswa->id, 'search' => request('search')]) }}" class="btn btn-sm btn-success">Pilih</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="mt-3 text-center">Siswa tidak ditemukan.</p>
                @endif
            @endif
        </div>
    </div>

    {{-- FORM UTAMA PEMBAYARAN --}}
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">2. Detail Pembayaran</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.keuangan.pembayaran.store') }}" method="POST">
                @csrf

                {{-- Input Siswa (Terisi otomatis) --}}
                <div class="form-group">
                    <label for="nama_siswa">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama_siswa" placeholder="Pilih siswa dari hasil pencarian di atas..." 
                           value="{{ $selectedSiswa ? $selectedSiswa->nama_siswa . ' (NIS: ' . $selectedSiswa->nis . ')' : '' }}" readonly required>
                    <input type="hidden" name="siswa_id" id="siswa_id" value="{{ $selectedSiswa ? $selectedSiswa->id : '' }}">
                </div>

                <div class="form-group">
                    <label for="tahun_ajaran_id">Tahun Ajaran</label>
                    <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control" required {{ !$selectedSiswa ? 'disabled' : '' }}>
                        <option value="">-- Pilih Tahun Ajaran --</option>
                        @foreach ($tahunAjarans as $ta)
                            <option value="{{ $ta->id }}">{{ $ta->tahun_ajaran }} - {{ $ta->semester }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal_bayar">Tanggal Bayar</label>
                    <input type="date" class="form-control" id="tanggal_bayar" name="tanggal_bayar" value="{{ date('Y-m-d') }}" required {{ !$selectedSiswa ? 'disabled' : '' }}>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bulan_spp">Bulan SPP</label>
                            <select name="bulan_spp" id="bulan_spp" class="form-control" required {{ !$selectedSiswa ? 'disabled' : '' }}>
                                <option value="">-- Pilih Bulan --</option>
                                @foreach (['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                                    <option value="{{ $loop->iteration }}">{{ $bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun_spp">Tahun SPP</label>
                            <input type="number" class="form-control" id="tahun_spp" name="tahun_spp" placeholder="Contoh: {{ date('Y') }}" value="{{ date('Y') }}" required {{ !$selectedSiswa ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_bayar">Jumlah Bayar (Rp)</label>
                            <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="Masukkan nominal pembayaran" required {{ !$selectedSiswa ? 'disabled' : '' }}>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipe_pembayaran">Tipe Pembayaran</label>
                            <select name="tipe_pembayaran" id="tipe_pembayaran" class="form-control" required {{ !$selectedSiswa ? 'disabled' : '' }}>
                                <option value="Cash">Cash</option>
                                <option value="QRIS">QRIS</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan (Opsional)</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" {{ !$selectedSiswa ? 'disabled' : '' }}></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block" {{ !$selectedSiswa ? 'disabled' : '' }}>Simpan</button>
                <a href="{{ route('admin.keuangan.pembayaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>  
    </div>

</div>
@endsection
