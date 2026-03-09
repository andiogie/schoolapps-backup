@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pendaftaran</h1>
    </div>

    <div class="row">
        <!-- Kolom Kiri: Detail Pendaftar -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Calon Siswa</h6>
                    @php
                        $statusClass = '';
                        $statusText = ucfirst($pendaftaran->status);
                        if ($pendaftaran->status == 'pending') {
                            $statusClass = 'bg-warning text-dark';
                        } elseif ($pendaftaran->status == 'verified') {
                            $statusClass = 'bg-success text-white';
                            $statusText = 'Diterima';
                        } else { 
                            $statusClass = 'bg-danger text-white';
                            $statusText = 'Ditolak';
                        }
                    @endphp
                    <span class="badge {{ $statusClass }} p-2">{{ $statusText }}</span>
                </div>
                <div class="card-body">
                    <!-- Data Diri -->
                    <div class="mb-4">
                        <h5 class="font-weight-bold">Data Diri</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nama Lengkap:</strong> {{ $pendaftaran->nama_lengkap }}</p>
                                <p><strong>No. Pendaftaran:</strong> {{ $pendaftaran->no_pendaftaran }}</p>
                                <p><strong>Tempat, Tgl Lahir:</strong> {{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir->format('d F Y') }}</p>
                                <p><strong>Jenis Kelamin:</strong> {{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Agama:</strong> {{ $pendaftaran->agama }}</p>
                                <p><strong>No. HP:</strong> {{ $pendaftaran->no_hp }}</p>
                                <p><strong>Email:</strong> {{ $pendaftaran->email }}</p>
                                <p><strong>Alamat:</strong> {{ $pendaftaran->alamat }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Keluarga -->
                    <div class="mb-4">
                        <h5 class="font-weight-bold">Data Keluarga</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nomor KK:</strong> {{ $pendaftaran->nomor_kk }}</p>
                                <p><strong>Nama Ayah:</strong> {{ $pendaftaran->nama_ayah }}</p>
                                <p><strong>Pekerjaan Ayah:</strong> {{ $pendaftaran->pekerjaan_ayah }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Nama Ibu:</strong> {{ $pendaftaran->nama_ibu }}</p>
                                <p><strong>Pekerjaan Ibu:</strong> {{ $pendaftaran->pekerjaan_ibu }}</p>
                                <p><strong>No. HP Orang Tua:</strong> {{ $pendaftaran->no_hp_ortu }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Akademik & Dokumen -->
                    <div>
                        <h5 class="font-weight-bold">Data Akademik & Dokumen</h5>
                        <hr>
                        <div class="row">
                             <div class="col-md-6">
                                <p><strong>Asal Sekolah:</strong> {{ $pendaftaran->asal_sekolah }}</p>
                                <p><strong>Pilihan Jurusan:</strong> <span class="font-weight-bold text-info">{{ $pendaftaran->jurusan }}</span></p>
                             </div>
                             <div class="col-md-6">
                                <p><strong>Dokumen Ijazah/SKL:</strong></p>
                                <a href="{{ Storage::url($pendaftaran->ijazah_path) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Lihat Dokumen
                                </a>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Panel Verifikasi -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Panel Verifikasi</h6>
                </div>
                <div class="card-body">
                    @if ($pendaftaran->status == 'pending')
                        <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="status" class="font-weight-bold">Ubah Status Pendaftaran</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="pending" selected>Menunggu Verifikasi</option>
                                    <option value="verified">Diterima</option>
                                    <option value="rejected">Ditolak</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="catatan" class="font-weight-bold">Catatan Admin (Opsional)</label>
                                <textarea id="catatan" name="catatan" rows="4" class="form-control" placeholder="Contoh: Berkas sudah lengkap dan diverifikasi.">{{ old('catatan', $pendaftaran->catatan) }}</textarea>
                                <small class="form-text text-muted">Catatan ini hanya untuk arsip internal.</small>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    @elseif ($pendaftaran->status == 'verified')
                        <div class="alert alert-success text-center">
                            Pendaftaran ini sudah diverifikasi dan tidak dapat diubah lagi.
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Status Akhir</label>
                            <p><span class="badge bg-success text-white">Diterima</span></p>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Catatan Admin</label>
                            <p class="text-muted">{{ $pendaftaran->catatan ?: '-' }}</p>
                        </div>
                        <div class="d-flex justify-content-start mt-4">
                            <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    @else
                        <div class="alert alert-danger text-center">
                            Tindakan telah diambil untuk pendaftaran ini dan tidak dapat diubah lagi.
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Status Akhir</label>
                            <p><span class="badge bg-danger text-white">Ditolak</span></p>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Catatan Admin</label>
                            <p class="text-muted">{{ $pendaftaran->catatan ?: '-' }}</p>
                        </div>
                         <div class="d-flex justify-content-start mt-4">
                            <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
