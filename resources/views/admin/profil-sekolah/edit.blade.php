@extends('layouts.admin')

@section('title', 'Edit Profil Sekolah')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Edit Profil Sekolah</h6>
                    </div>
                </div>
                <div class="card-body px-4 pb-4">

                    <form action="{{ route('admin.profil-sekolah.update', $profil->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Sekolah</label>
                                    <input type="text" class="form-control ps-2" name="nama_sekolah" value="{{ old('nama_sekolah', $profil->nama_sekolah) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Kepala Sekolah</label>
                                    <input type="text" class="form-control ps-2" name="nama_kepala_sekolah" value="{{ old('nama_kepala_sekolah', $profil->nama_kepala_sekolah) }}" readonly>
                                    <div class="form-text">Nama kepala sekolah diambil otomatis dari data guru yang aktif.</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control ps-2" name="telepon" value="{{ old('telepon', $profil->telepon) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Alamat Email</label>
                                    <input type="email" class="form-control ps-2" name="email" value="{{ old('email', $profil->email) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="form-label">Alamat Website</label>
                                    <input type="url" class="form-control ps-2" name="website" value="{{ old('website', $profil->website) }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                             <label class="form-label">Alamat Sekolah</label>
                             <textarea class="form-control ps-2" name="alamat" rows="3" required>{{ old('alamat', $profil->alamat) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                             <label class="form-label">Visi</label>
                             <textarea class="form-control ps-2" name="visi" rows="5" required>{{ old('visi', $profil->visi) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                             <label class="form-label">Misi</label>
                             <textarea class="form-control ps-2" name="misi" rows="5" required>{{ old('misi', $profil->misi) }}</textarea>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-8">
                                 <div class="form-group mb-3">
                                    <label for="logo" class="form-label">Ubah Logo Sekolah (Opsional)</label>
                                    <input class="form-control" type="file" id="logo" name="logo">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <p class="mb-1">Logo Saat Ini:</p>
                                @if ($profil->logo_path)
                                    <img id="logo-preview" src="{{ asset($profil->logo_path) }}" alt="Logo Saat Ini" class="img-fluid rounded" style="max-height: 100px; display: block; margin: auto;"/>
                                @else
                                    <img id="logo-preview" src="https://via.placeholder.com/150x50?text=Tidak+Ada+Logo" alt="Tidak ada logo" class="img-fluid rounded" style="max-height: 100px; display: block; margin: auto;"/>
                                @endif
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end">
                             <a href="{{ route('admin.dashboard') }}" class="btn bg-gradient-secondary me-2">Batal</a>
                            <button type="submit" class="btn bg-gradient-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const logoInput = document.querySelector('#logo');
    const preview = document.querySelector('#logo-preview');
    if (!logoInput) return;

    logoInput.addEventListener('change', function() {
        if (logoInput.files && logoInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(logoInput.files[0]);
        } 
    });
});
</script>
@endpush
