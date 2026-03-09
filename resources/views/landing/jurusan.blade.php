@extends('layouts.landing')

@section('title', 'Jurusan Unggulan')

@push('styles')
<style>
    .jurusan-header {
        text-align: center;
        padding: 4rem 0;
        background-color: #f8f9fa;
    }
    .jurusan-header h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #343a40;
    }
    .jurusan-header p {
        font-size: 1.25rem;
        color: #6c757d;
        max-width: 800px;
        margin: 0 auto;
    }
    .jurusan-list {
        padding: 4rem 0;
    }
    .jurusan-card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .jurusan-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }
    .jurusan-card-banner {
        height: 200px;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 2rem;
        font-weight: 700;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
    }
    .jurusan-card-content {
        padding: 2rem;
        text-align: center;
    }
    .jurusan-card-content i {
        font-size: 3rem;
        color: #007bff;
        margin-bottom: 1rem;
    }
    .jurusan-card-content h3 {
        font-size: 1.75rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    .jurusan-card-content p {
        color: #6c757d;
    }
</style>
@endpush

@section('content')

<div class="jurusan-header">
    <div class="container">
        <h1>Jurusan Unggulan di Sekolah Hebat</h1>
        <p>Temukan passion Anda dan persiapkan diri untuk karir masa depan di salah satu jurusan unggulan kami.</p>
    </div>
</div>

<div class="jurusan-list">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="jurusan-card">
                    <div class="jurusan-card-banner" style="background-image: url('https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070&auto=format&fit=crop');">
                    </div>
                    <div class="jurusan-card-content">
                        <i class="fas fa-robot"></i>
                        <h3>Rekayasa Perangkat Lunak</h3>
                        <p>Fokus pada pengembangan perangkat lunak yang inovatif, mulai dari aplikasi web modern hingga solusi mobile canggih. Kurikulum kami dirancang untuk membekali Anda dengan keterampilan coding, arsitektur sistem, dan manajemen proyek yang relevan dengan kebutuhan industri teknologi terkini.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jurusan-card">
                    <div class="jurusan-card-banner" style="background-image: url('https://images.unsplash.com/photo-1572044162444-24c95c899165?q=80&w=2070&auto=format&fit=crop');">
                    </div>
                    <div class="jurusan-card-content">
                        <i class="fas fa-paint-brush"></i>
                        <h3>Desain Komunikasi Visual</h3>
                        <p>Mengasah kepekaan visual dan kreativitas untuk menghasilkan karya desain yang berdampak. Anda akan belajar tentang branding, ilustrasi digital, tipografi, dan desain antarmuka (UI/UX) untuk berbagai media, mempersiapkan Anda menjadi desainer profesional yang serba bisa.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jurusan-card">
                    <div class="jurusan-card-banner" style="background-image: url('https://images.unsplash.com/photo-1554224155-16954435a260?q=80&w=2070&auto=format&fit=crop');">
                    </div>
                    <div class="jurusan-card-content">
                        <i class="fas fa-chart-line"></i>
                        <h3>Akuntansi & Keuangan</h3>
                        <p>Mempersiapkan Anda untuk menjadi ahli di bidang keuangan dan akuntansi yang kompeten. Program ini mencakup analisis laporan keuangan, perpajakan, audit, dan manajemen keuangan korporat, memberikan landasan yang kuat untuk berkarir di sektor perbankan, bisnis, atau pemerintahan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
