@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Jadwal Pelajaran</h1>

    {{-- Menampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.master.jadwal-pelajaran.update', $jadwalPelajaran->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="tahun_ajaran_id" class="form-label">Tahun Ajaran</label>
                    <select class="form-control" id="tahun_ajaran_id" name="tahun_ajaran_id" required>
                        @foreach ($tahunAjarans as $tahunAjaran)
                            <option value="{{ $tahunAjaran->id }}" {{ (old('tahun_ajaran_id', $jadwalPelajaran->tahun_ajaran_id) == $tahunAjaran->id) ? 'selected' : '' }}>{{ $tahunAjaran->tahun_ajaran }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kelas_id" class="form-label">Kelas</label>
                    <select class="form-control" id="kelas_id" name="kelas_id" required>
                        @foreach ($kelas as $kls)
                            <option value="{{ $kls->id }}" {{ (old('kelas_id', $jadwalPelajaran->kelas_id) == $kls->id) ? 'selected' : '' }}>{{ $kls->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="hari" class="form-label">Hari</label>
                    <select class="form-control" id="hari" name="hari" required>
                        <option value="Senin" {{ (old('hari', $jadwalPelajaran->hari) == 'Senin') ? 'selected' : '' }}>Senin</option>
                        <option value="Selasa" {{ (old('hari', $jadwalPelajaran->hari) == 'Selasa') ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ (old('hari', $jadwalPelajaran->hari) == 'Rabu') ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ (old('hari', $jadwalPelajaran->hari) == 'Kamis') ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ (old('hari', $jadwalPelajaran->hari) == 'Jumat') ? 'selected' : '' }}>Jumat</option>
                        <option value="Sabtu" {{ (old('hari', $jadwalPelajaran->hari) == 'Sabtu') ? 'selected' : '' }}>Sabtu</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai', $jadwalPelajaran->jam_mulai) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai', $jadwalPelajaran->jam_selesai) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="mapel_id" class="form-label">Mata Pelajaran</label>
                    <select class="form-control" id="mapel_id" name="mapel_id" required>
                        @foreach ($mapels as $mapel)
                            <option value="{{ $mapel->id }}" {{ (old('mapel_id', $jadwalPelajaran->mapel_id) == $mapel->id) ? 'selected' : '' }}>{{ $mapel->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="guru_id" class="form-label">Guru</label>
                    <select class="form-control" id="guru_id" name="guru_id" required>
                        @foreach ($gurus as $guru)
                            <option value="{{ $guru->id }}" {{ (old('guru_id', $jadwalPelajaran->guru_id) == $guru->id) ? 'selected' : '' }}>{{ $guru->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.master.jadwal-pelajaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
