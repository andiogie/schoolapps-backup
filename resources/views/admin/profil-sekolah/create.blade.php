@extends('layouts.admin')

@section('title', 'Buat Profil Sekolah')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.profil-sekolah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                            <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah" name="nama_sekolah" value="{{ old('nama_sekolah') }}" required>
                            @error('nama_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_kepala_sekolah" class="form-label">Nama Kepala Sekolah</label>
                            <input type="text" class="form-control @error('nama_kepala_sekolah') is-invalid @enderror" id="nama_kepala_sekolah" name="nama_kepala_sekolah" value="{{ old('nama_kepala_sekolah', $namaKepalaSekolahOtomatis) }}" required @if($namaKepalaSekolahOtomatis) readonly @endif>
                            @error('nama_kepala_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($namaKepalaSekolahOtomatis)
                                <div class="form-text">Nama kepala sekolah diambil otomatis dari data guru yang aktif.</div>
                            @else
                                <div class="form-text">Kepala sekolah tidak diatur di data guru. Harap isi manual atau <a href=\"{{ route('admin.master.guru.index') }}\">atur di sini</a>.</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon') }}" required>
                            @error('telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="website" class="form-label">Alamat Website</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}">
                             @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Sekolah</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="visi" class="form-label">Visi</label>
                    <textarea class="form-control @error('visi') is-invalid @enderror" id="visi" name="visi" rows="5" required>{{ old('visi') }}</textarea>
                    @error('visi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="misi" class="form-label">Misi</label>
                    <textarea class="form-control @error('misi') is-invalid @enderror" id="misi" name="misi" rows="5" required>{{ old('misi') }}</textarea>
                    @error('misi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                 <div class="row align-items-center">
                    <div class="col-md-8">
                         <div class="mb-3">
                            <label for="logo" class="form-label">Logo Sekolah</label>
                            <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="logo" onchange="previewLogo()" required>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1 text-center">Preview Logo:</p>
                        <img id="logo-preview" src="https://via.placeholder.com/150" alt="Tidak ada logo" class="img-fluid rounded" style="max-height: 150px; display: block; margin: auto;"/>
                    </div>
                </div>

                <hr class="my-4">

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewLogo() {
    const logo = document.querySelector('#logo');
    const preview = document.querySelector('#logo-preview');

    if (logo.files && logo.files[0]) {
        preview.style.display = 'block';
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(logo.files[0]);
    } else {
        preview.style.display = 'none';
        preview.src = "https://via.placeholder.com/150";
    }
}
</script>
@endpush
