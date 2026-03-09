@extends('layouts.guru')

@section('title', 'Ubah Password')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header p-3 pb-0">
                    <h6 class="mb-0">Ubah Password</h6>
                    <p class="text-sm mb-0">Pastikan untuk menggunakan password yang kuat dan mudah Anda ingat.</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('guru.profil.update-password') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Lama</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                             @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class_="d-flex justify-content-end">
                            <a href="{{ route('guru.profil.show') }}" class="btn btn-outline-secondary me-2">Batal</a>
                            <button type="submit" class="btn bg-gradient-success">Perbarui Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
