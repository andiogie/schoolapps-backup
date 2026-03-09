@extends('layouts.admin')

@section('title', 'Edit Siswa')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Siswa: {{ $siswa->nama_siswa }}</h1>
        <a href="{{ route('admin.master.siswa.index') }}" class="btn btn-sm btn-secondary shadow-sm">Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Siswa</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.master.siswa.update', $siswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Informasi Akademik --}}
                <h6 class="font-weight-bold">Informasi Akademik & Login</h6>
                <hr class="mt-0">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="nis">NIS <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}" required>
                    </div>
                    <div class="col-md-8 form-group">
                        <label for="nama_siswa">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa) }}" required>
                        <small class="form-text text-muted">Mengubah ini juga akan mengubah nama login pengguna.</small>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="kelas_id">Kelas <span class="text-danger">*</span></label>
                        <select class="form-control" id="kelas_id" name="kelas_id" required>
                            @foreach($kelases as $kelas)
                                <option value="{{ $kelas->id }}" {{ old('kelas_id', $siswa->kelas_id) == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="jurusan_id">Jurusan <span class="text-danger">*</span></label>
                        <select class="form-control" id="jurusan_id" name="jurusan_id" required>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $siswa->jurusan_id) == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Informasi Pribadi --}}
                <h6 class="font-weight-bold mt-4">Informasi Pribadi</h6>
                <hr class="mt-0">
                <div class="row">
                     <div class="col-md-4 form-group">
                        <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="agama">Agama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="agama" name="agama" value="{{ old('agama', $siswa->agama) }}" required>
                    </div>
                    <div class="col-12 form-group">
                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                    </div>
                </div>

                {{-- Informasi Kontak & Asal --}}
                <h6 class="font-weight-bold mt-4">Informasi Kontak & Asal Sekolah</h6>
                <hr class="mt-0">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="no_hp">No. HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="asal_sekolah">Asal Sekolah</label>
                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah', $siswa->asal_sekolah) }}">
                    </div>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('admin.master.siswa.index') }}" class="btn btn-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
