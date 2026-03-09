<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sekolah Hebat') - {{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>

    <!-- Header -->
    <header class="navbar">
        <div class="container">
            <a href="/" class="navbar-brand">
                <i class="fas fa-school"></i>
                <span>SekolahHebat</span>
            </a>
            <div class="navbar-menu-wrapper">
                <ul class="navbar-menu">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="{{ route('visi-misi') }}">Visi & Misi</a></li>
                    <li><a href="{{ route('jurusan') }}">Jurusan</a></li>
                    <li><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
                    <li><a href="{{ route('prestasi') }}">Prestasi</a></li>
                    <li><a href="{{ route('mengapa-kami') }}">Mengapa Kami</a></li>
                </ul>
                <a href="{{ route('daftar') }}" class="btn btn-primary">Daftar Sekarang</a>
            </div>
            <button class="navbar-toggler" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-about">
                    <h3>SekolahHebat</h3>
                    <p>Jl. Pendidikan No. 123, Kota Ilmu, Indonesia.</p>
                    <p>Email: <a href="mailto:info@sekolahhebat.sch.id">info@sekolahhebat.sch.id</a></p>
                    <p>Telepon: (021) 123-4567</p>
                </div>
                <div class="footer-links">
                    <h3>Tautan Cepat</h3>
                    <ul>
                        <li><a href="/">Beranda</a></li>
                        <li><a href="{{ route('visi-misi') }}">Visi & Misi</a></li>
                        <li><a href="{{ route('jurusan') }}">Jurusan</a></li>
                        <li><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
                        <li><a href="{{ route('daftar') }}">Pendaftaran</a></li>
                    </ul>
                </div>
                <div class="footer-social">
                    <h3>Ikuti Kami</h3>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 SekolahHebat. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts')
</body>
</html>
