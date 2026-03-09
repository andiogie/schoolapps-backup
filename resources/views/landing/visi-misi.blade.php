@extends('layouts.landing')

@section('title', 'Visi & Misi')

@push('styles')
<style>
    .visi-misi-container {
        background-color: #f8f9fa;
        padding: 60px 0;
    }
    .section-title {
        text-align: center;
        margin-bottom: 50px;
        color: #343a40;
    }
    .card-custom {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px 0 rgba(0,0,0,0.1);
        margin-bottom: 30px;
        background: #fff;
    }
    .card-header-custom {
        background-color: #007bff;
        color: white;
        border-radius: 15px 15px 0 0 !important;
        padding: 20px;
        font-size: 1.5rem;
        font-weight: 600;
    }
    .card-body-custom {
        padding: 30px;
    }
    .card-body-custom p, .card-body-custom ul {
        color: #6c757d;
        font-size: 1.1rem;
        line-height: 1.8;
    }
    .card-body-custom ul {
        padding-left: 20px;
    }
     .card-body-custom li {
        margin-bottom: 10px;
    }
</style>
@endpush

@section('content')
<div class="visi-misi-container">
    <div class="container">
        <h2 class="section-title">Visi & Misi Sekolah</h2>

        @if($profil)
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Visi Card -->
                    <div class="card card-custom">
                        <div class="card-header card-header-custom">
                            <i class="fas fa-eye me-2"></i> Visi
                        </div>
                        <div class="card-body card-body-custom">
                            <p>{{ $profil->visi ?? 'Visi sekolah belum diatur.' }}</p>
                        </div>
                    </div>

                    <!-- Misi Card -->
                    <div class="card card-custom">
                        <div class="card-header card-header-custom bg-success">
                             <i class="fas fa-bullseye me-2"></i> Misi
                        </div>
                        <div class="card-body card-body-custom">
                            @if($profil->misi)
                                {!! nl2br(e($profil->misi)) !!}
                            @else
                                <p>Misi sekolah belum diatur.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center">
                Profil sekolah belum diatur. Silakan hubungi admin.
            </div>
        @endif

    </div>
</div>
@endsection
