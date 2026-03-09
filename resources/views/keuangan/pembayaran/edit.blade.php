@extends('layouts.admin')

@section('title', 'Edit Pembayaran SPP')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Pembayaran SPP</h1>
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

    <!-- Content Row -->
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.keuangan.pembayaran.update', $pembayaran->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Menampilkan Nama Siswa sebagai Teks --}}
                <div class="form-group">
                    <label>Nama Siswa</label>
                    <p class="form-control-plaintext"><strong>{{ $pembayaran->siswa->nama_siswa ?? 'Siswa tidak ditemukan' }}</strong> (NIS: {{ $pembayaran->siswa->nis ?? '-' }})</p>
                    <input type="hidden" name="siswa_id" value="{{ $pembayaran->siswa_id }}">
                </div>

                <div class="form-group">
                    <label for="tahun_ajaran_id">Tahun Ajaran</label>
                    <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control" required>
                        <option value="">-- Pilih Tahun Ajaran --</option>
                        @foreach ($tahunAjarans as $ta)
                            <option value="{{ $ta->id }}" {{ old('tahun_ajaran_id', $pembayaran->tahun_ajaran_id) == $ta->id ? 'selected' : '' }}>
                                {{ $ta->tahun_ajaran }} - {{ $ta->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal_bayar">Tanggal Bayar</label>
                    <input type="date" class="form-control" id="tanggal_bayar" name="tanggal_bayar" value="{{ old('tanggal_bayar', $pembayaran->tanggal_bayar) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bulan_spp">Bulan SPP</label>
                            <select name="bulan_spp" id="bulan_spp" class="form-control" required>
                                <option value="">-- Pilih Bulan --</option>
                                @foreach ([
                                    'Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4, 'Mei' => 5, 'Juni' => 6, 
                                    'Juli' => 7, 'Agustus' => 8, 'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12
                                ] as $bulan => $angka)
                                    <option value="{{ $angka }}" {{ old('bulan_spp', $pembayaran->bulan_spp) == $angka ? 'selected' : '' }}>
                                        {{ $bulan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun_spp">Tahun SPP</label>
                            <input type="number" class="form-control" id="tahun_spp" name="tahun_spp" placeholder="Contoh: 2023" value="{{ old('tahun_spp', $pembayaran->tahun_spp) }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_bayar">Jumlah Bayar (Rp)</label>
                            <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="Masukkan nominal pembayaran" value="{{ old('jumlah_bayar', $pembayaran->jumlah_bayar) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipe_pembayaran">Tipe Pembayaran</label>
                            <select name="tipe_pembayaran" id="tipe_pembayaran" class="form-control" required>
                                <option value="Cash" {{ old('tipe_pembayaran', $pembayaran->tipe_pembayaran) == 'Cash' ? 'selected' : '' }}>Cash</option>
                                <option value="QRIS" {{ old('tipe_pembayaran', $pembayaran->tipe_pembayaran) == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                <option value="Transfer" {{ old('tipe_pembayaran', $pembayaran->tipe_pembayaran) == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan (Opsional)</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Update</button>
                <a href="{{ route('admin.keuangan.pembayaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>  
    </div>

</div>
@endsection
