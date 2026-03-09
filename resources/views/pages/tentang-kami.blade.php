@php
    $layout = 'layouts.app'; // Default layout jika tidak ada yang login
    if (Auth::guard('admin')->check()) {
        $layout = 'layouts.admin';
    } elseif (Auth::guard('guru')->check()) {
        $layout = 'layouts.guru';
    } elseif (Auth::guard('siswa')->check()) {
        $layout = 'layouts.siswa';
    }
@endphp

@extends($layout)

@section('title', 'Tentang Kami')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Tentang Aplikasi</h6>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    
                    <div class="mb-4">
                        <h3>Selamat Datang di Sistem Informasi Sekolah</h3>
                        <p class="text-secondary">Platform terintegrasi untuk memudahkan manajemen dan kegiatan belajar mengajar di sekolah kita.</p>
                    </div>

                    <div class="mb-4">
                        <h5>Untuk Administrator</h5>
                        <p>Sebagai admin, Anda memiliki kontrol penuh atas infrastruktur digital sekolah. Kelola data master, pendaftaran siswa baru, keuangan, hingga profil sekolah dengan mudah. Sistem ini dirancang untuk menyederhanakan tugas administratif Anda sehingga Anda dapat fokus pada hal-hal yang lebih strategis.</p>
                    </div>

                    <div class="mb-4">
                        <h5>Untuk Guru</h5>
                        <p>Kami menyediakan perangkat yang Anda butuhkan untuk mengelola kelas secara efisien. Mulai dari mencatat absensi, memberikan tugas, mengunggah materi pelajaran, hingga mengisi rapor siswa, semuanya dapat dilakukan dalam satu platform. Manfaatkan waktu Anda untuk berinteraksi lebih banyak dengan siswa, bukan untuk pekerjaan administratif.</p>
                    </div>

                    <div class="mb-4">
                        <h5>Untuk Siswa</h5>
                        <p>Jelajahi dunia pengetahuan dengan lebih mudah. Akses materi pelajaran, kumpulkan tugas, lihat riwayat absensi, dan pantau nilai rapor Anda langsung dari dasbor siswa. Kami percaya, dengan akses yang mudah terhadap informasi, proses belajar Anda akan menjadi lebih efektif dan menyenangkan.</p>
                    </div>

                    <hr class="horizontal dark my-4">

                    <p>Aplikasi ini dikembangkan dan dikelola oleh <strong>Andi Putra Ogie</strong>. Kami berkomitmen untuk terus meningkatkan dan memberikan pengalaman terbaik bagi seluruh warga sekolah.</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
