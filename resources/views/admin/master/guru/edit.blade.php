@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Guru</h1>

    {{-- Menangani Error Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.master.guru.update', $guru->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Input Fields --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Guru</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $guru->nama) }}" required>
                </div>
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $guru->nip) }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $guru->email) }}">
                </div>
                <div class="mb-3">
                    <label for="mapel_id" class="form-label">Mata Pelajaran</label>
                    <select class="form-control" id="mapel_id" name="mapel_id" required>
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach($mapels as $mapel)
                            <option value="{{ $mapel->id }}" {{ old('mapel_id', $guru->mapel_id) == $mapel->id ? 'selected' : '' }}>{{ $mapel->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>
                
                <hr>
                
                {{-- Checkboxes --}}
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ old('is_active', $guru->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Akun Aktif</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_kepala_sekolah" name="is_kepala_sekolah" {{ old('is_kepala_sekolah', $guru->is_kepala_sekolah) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_kepala_sekolah">Jadikan Kepala Sekolah</label>
                </div>

                {{-- Logika Wali Kelas --}}
                <div class="form-group row align-items-center mb-3">
                    <div class="col-sm-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_wali_kelas" name="is_wali_kelas" {{ old('is_wali_kelas', $guru->is_wali_kelas) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_wali_kelas">Jadikan Wali Kelas</label>
                        </div>
                    </div>
                    <div class="col-sm-9" id="wali_kelas_group" style="display: none;">
                        <select class="form-control" id="kelas_id" name="kelas_id">
                            <option value="">Pilih Kelas...</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id', optional($guru->kelasWali)->id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.master.guru.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const waliKelasCheckbox = document.getElementById('is_wali_kelas');
        const waliKelasGroup = document.getElementById('wali_kelas_group');
        const kelasSelect = document.getElementById('kelas_id');

        function toggleWaliKelasGroup() {
            if (waliKelasCheckbox.checked) {
                waliKelasGroup.style.display = 'block';
            } else {
                waliKelasGroup.style.display = 'none';
                // Reset pilihan dropdown saat disembunyikan untuk mencegah pengiriman data yang tidak diinginkan
                kelasSelect.value = ''; 
            }
        }

        // Jalankan saat halaman pertama kali dimuat
        toggleWaliKelasGroup();

        // Jalankan setiap kali checkbox diubah
        waliKelasCheckbox.addEventListener('change', toggleWaliKelasGroup);
    });
</script>
@endpush
