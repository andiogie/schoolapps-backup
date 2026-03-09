@extends('layouts.guru')

@section('title', 'Profil Guru')

@push('styles')
<style>
    .info-group {
        margin-bottom: 1.5rem;
    }
    .info-label {
        font-weight: 600;
        color: #344767;
        font-size: 0.875rem;
    }
    .info-value {
        font-size: 1rem;
        color: #6c757d;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ asset('admin-template/img/team-3.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $guru->nama }}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        Guru / Pengajar
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item">
                            <a class="btn btn-sm bg-gradient-success mb-0" href="{{ route('guru.profil.change-password') }}">
                                <i class="material-icons text-sm">lock_reset</i>
                                <span class="ms-1">Ubah Password</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body p-3">
             @if (session('status'))
                <div class="alert alert-success text-white" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <h6 class="mb-3">Informasi Pribadi</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <span class="info-label">Nama Lengkap</span>
                                <p class="info-value">{{ $guru->nama }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <span class="info-label">NIP</span>
                                <p class="info-value">{{ $guru->nip }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <span class="info-label">Email</span>
                                <p class="info-value">{{ $guru->email }}</p>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="info-group">
                                <span class="info-label">Mata Pelajaran</span>
                                <p class="info-value">{{ $guru->mapel ? $guru->mapel->nama_mapel : 'Tidak mengajar mata pelajaran tertentu' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
