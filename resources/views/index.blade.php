@extends('layouts.landing')

@section('title', 'Selamat Datang')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero-section">
        <div class="container">
            <h1>Membentuk Masa Depan Cerah, Satu Siswa pada Satu Waktu</h1>
            <p>Bergabunglah dengan komunitas kami yang dinamis dan raih potensi penuh Anda. Pendaftaran tahun ajaran baru telah dibuka!</p>
            <a href="{{ route('daftar') }}" class="btn btn-primary">Mulai Pendaftaran <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1594495894542-a46cc73e081a?q=80&w=2071&auto=format&fit=crop" alt="Gedung Sekolah">
                </div>
                <div class="about-text">
                    <h2>Selamat Datang di SekolahHebat</h2>
                    <p>SekolahHebat adalah lembaga pendidikan yang berdedikasi untuk memberikan pengalaman belajar-mengajar terbaik dengan kurikulum modern dan fasilitas lengkap. Kami percaya setiap siswa memiliki potensi unik, dan tugas kami adalah membimbing mereka untuk menjadi individu yang berprestasi, kreatif, dan berkarakter.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Majors Section -->
    <section id="majors" class="majors-section">
        <div class="container">
            <h2>Jurusan Unggulan Kami</h2>
            <div class="majors-grid">
                <div class="major-card">
                    <i class="fas fa-robot"></i>
                    <h3>Rekayasa Perangkat Lunak</h3>
                    <p>Mempelajari pengembangan software, aplikasi web, dan mobile yang relevan dengan industri teknologi saat ini.</p>
                </div>
                <div class="major-card">
                    <i class="fas fa-paint-brush"></i>
                    <h3>Desain Komunikasi Visual</h3>
                    <p>Mengasah kreativitas dalam desain grafis, ilustrasi, dan media interaktif untuk kebutuhan komunikasi visual.</p>
                </div>
                <div class="major-card">
                    <i class="fas fa-chart-line"></i>
                    <h3>Akuntansi & Keuangan</h3>
                    <p>Mempersiapkan siswa menjadi ahli keuangan yang kompeten, teliti, dan profesional di dunia bisnis.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Facilities Section -->
    <section id="facilities" class="facilities-section">
        <div class="container">
            <h2>Fasilitas Modern & Lengkap</h2>
            <div class="facilities-grid">
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1581092446347-a8a2d15a4f21?q=80&w=2070&auto=format&fit=crop" alt="Laboratorium">
                    <div class="facility-info">
                        <h3>Laboratorium Komputer</h3>
                        <p>Dilengkapi dengan perangkat terkini untuk menunjang pembelajaran teknologi.</p>
                    </div>
                </div>
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?q=80&w=2070&auto=format&fit=crop" alt="Perpustakaan">
                    <div class="facility-info">
                        <h3>Perpustakaan Digital</h3>
                        <p>Akses ke ribuan buku dan jurnal online untuk mendukung riset dan literasi.</p>
                    </div>
                </div>
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=1949&auto=format&fit=crop" alt="Area Kreatif">
                    <div class="facility-info">
                        <h3>Ruang Kreatif & Diskusi</h3>
                        <p>Area kolaboratif yang nyaman untuk siswa bekerja sama dan berinovasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section id="cta" class="cta-section">
        <div class="container">
            <h2>Siap Bergabung dengan Kami?</h2>
            <p>Jangan lewatkan kesempatan untuk menjadi bagian dari keluarga besar SekolahHebat. Daftar sekarang juga!</p>
            <a href="{{ route('daftar') }}" class="btn btn-light">Daftar Sekarang <i class="fas fa-chevron-right"></i></a>
        </div>
    </section>

@endsection
