
@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Tambah Jadwal Pelajaran</h6>
                    </div>
                </div>
                <div class="card-body px-4 pb-4">
                    <form action="{{ route('admin.master.jadwal-pelajaran.store') }}" method="POST">
                        @csrf
                        {{-- PERBAIKAN: Mengganti input-group-static menjadi input-group-outline --}}
                        <div class="input-group input-group-outline my-3">
                            {{-- <label class="form-label">Tahun Ajaran</label> --}}
                            <select class="form-control" id="tahun_ajaran_id" name="tahun_ajaran_id" required>
                                 <option value="">Pilih Tahun Ajaran</option>
                                @foreach ($tahunAjarans as $tahunAjaran)
                                    <option value="{{ $tahunAjaran->id }}">{{ $tahunAjaran->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- PERBAIKAN: Mengganti input-group-static menjadi input-group-outline --}}
                        <div class="input-group input-group-outline my-3">
                            {{-- <label class="form-label">Kelas</label> --}}
                            <select class="form-control" id="kelas_id" name="kelas_id" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- PERBAIKAN: Mengganti input-group-static menjadi input-group-outline --}}
                        <div class="input-group input-group-outline my-3">
                            {{-- <label class="form-label">Hari</label> --}}
                            <select class="form-control" id="hari" name="hari" required>
                                <option value="">Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>
                        <div class="row">
                             <div class="col-md-6">
                                {{-- PERBAIKAN: Mengganti input-group-static menjadi input-group-outline --}}
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Jam Mulai</label>
                                    <input type="time" class="form-control" name="jam_mulai" required>
                                </div>
                            </div>
                           <div class="col-md-6">
                                {{-- PERBAIKAN: Mengganti input-group-static menjadi input-group-outline --}}
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Jam Selesai</label>
                                    <input type="time" class="form-control" name="jam_selesai" required>
                                </div>
                            </div>
                        </div>
                         {{-- PERBAIKAN: Mengganti input-group-static menjadi input-group-outline --}}
                         <div class="input-group input-group-outline my-3">
                            {{-- <label class="form-label">Mata Pelajaran</label> --}}
                            <select class="form-control" id="mapel_id" name="mapel_id" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($mapels as $mapel)
                                    <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- PERBAIKAN: Mengganti input-group-static menjadi input-group-outline --}}
                        <div class="input-group input-group-outline my-3">
                            {{-- <label class="form-label">Guru</label> --}}
                            <select class="form-control" id="guru_id" name="guru_id" required>
                                <option value="">Pilih Guru</option>
                                @foreach ($gurus as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.master.jadwal-pelajaran.index') }}" class="btn bg-gradient-secondary me-2">Batal</a>
                            <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
