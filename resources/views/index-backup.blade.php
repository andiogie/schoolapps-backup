<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMK Teknologi Nusantara</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#059669',
                        secondary: '#10b981',
                        dark: '#065f46',
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans">

    <!-- NAVBAR -->
    <nav id="navbar" class="fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">SMK Teknologi</h1>
                        <p class="text-xs text-green-100">Nusantara</p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <ul class="hidden md:flex space-x-8 text-white font-medium">
                    <li><a href="#home" class="nav-link hover:text-green-300 transition">Beranda</a></li>
                    <li><a href="#tentang" class="nav-link hover:text-green-300 transition">Tentang</a></li>
                    <li><a href="#jurusan" class="nav-link hover:text-green-300 transition">Jurusan</a></li>
                    <li><a href="#fasilitas" class="nav-link hover:text-green-300 transition">Fasilitas</a></li>
                    <li><a href="#prestasi" class="nav-link hover:text-green-300 transition">Prestasi</a></li>
                    <li><a href="#galeri" class="nav-link hover:text-green-300 transition">Galeri</a></li>
                    <li><a href="#kontak" class="nav-link hover:text-green-300 transition">Kontak</a></li>
                </ul>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden text-white text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-dark/95 backdrop-blur-lg">
            <ul class="px-4 py-6 space-y-4 text-white font-medium">
                <li><a href="#home" class="mobile-nav-link block py-2 hover:text-green-300">Beranda</a></li>
                <li><a href="#tentang" class="mobile-nav-link block py-2 hover:text-green-300">Tentang</a></li>
                <li><a href="#jurusan" class="mobile-nav-link block py-2 hover:text-green-300">Jurusan</a></li>
                <li><a href="#fasilitas" class="mobile-nav-link block py-2 hover:text-green-300">Fasilitas</a></li>
                <li><a href="#prestasi" class="mobile-nav-link block py-2 hover:text-green-300">Prestasi</a></li>
                <li><a href="#galeri" class="mobile-nav-link block py-2 hover:text-green-300">Galeri</a></li>
                <li><a href="#kontak" class="mobile-nav-link block py-2 hover:text-green-300">Kontak</a></li>
            </ul>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section id="home" class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        
        <div class="relative z-10 text-center text-white px-4 max-w-5xl mx-auto">
            <div class="animate-fade-in-up">
                <h2 class="text-4xl sm:text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    Wujudkan Masa Depan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-300 to-emerald-400">Gemilang Bersama Kami</span>
                </h2>
                <p class="text-lg sm:text-xl md:text-2xl mb-8 text-green-50 max-w-3xl mx-auto">
                    SMK Teknologi Nusantara - Membangun generasi unggul dengan pendidikan vokasi berkualitas tinggi
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('daftar') }}" class="group bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white font-bold px-8 py-4 rounded-full transition-all transform hover:scale-105 shadow-lg hover:shadow-2xl">
                        <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="#tentang" class="bg-white/10 backdrop-blur-md hover:bg-white/20 text-white font-bold px-8 py-4 rounded-full transition-all border-2 border-white/30 hover:border-white/50">
                        <i class="fas fa-info-circle mr-2"></i> Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <i class="fas fa-chevron-down text-white text-3xl"></i>
        </div>
    </section>

    <!-- TENTANG SECTION -->
    <section id="tentang" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="order-2 md:order-1">
                    <span class="text-primary font-semibold text-sm uppercase tracking-wider">Tentang Kami</span>
                    <h3 class="text-4xl font-bold mt-4 mb-6 text-gray-800">SMK Teknologi Nusantara</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        SMK Teknologi Nusantara adalah institusi pendidikan vokasi terkemuka yang berfokus pada pengembangan keterampilan praktis dan karakter siswa. Dengan kurikulum yang disesuaikan dengan kebutuhan industri, kami mempersiapkan siswa untuk siap kerja atau melanjutkan ke jenjang pendidikan lebih tinggi.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check-circle text-primary text-2xl mt-1"></i>
                            <div>
                                <h4 class="font-bold text-gray-800">Kurikulum Industri</h4>
                                <p class="text-gray-600">Sesuai dengan kebutuhan dunia kerja</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check-circle text-primary text-2xl mt-1"></i>
                            <div>
                                <h4 class="font-bold text-gray-800">Fasilitas Modern</h4>
                                <p class="text-gray-600">Lengkap dengan peralatan terkini</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check-circle text-primary text-2xl mt-1"></i>
                            <div>
                                <h4 class="font-bold text-gray-800">Sertifikasi Kompetensi</h4>
                                <p class="text-gray-600">Diakui oleh industri nasional</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 md:order-2">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=800&q=80" alt="Tentang SMK" class="rounded-2xl shadow-2xl">
                        <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-gradient-to-br from-primary to-secondary rounded-2xl opacity-20"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JURUSAN SECTION -->
    <section id="jurusan" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Program Keahlian</span>
                <h3 class="text-4xl font-bold mt-4 mb-4 text-gray-800">Jurusan Unggulan</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">Pilih jurusan sesuai minat dan bakat Anda untuk meraih masa depan cemerlang</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Jurusan 1 -->
                <div class="jurusan-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80" alt="RPL" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent opacity-70"></div>
                        <div class="absolute bottom-4 left-4">
                            <i class="fas fa-laptop-code text-white text-3xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl font-bold mb-3 text-gray-800">Rekayasa Perangkat Lunak</h4>
                        <p class="text-gray-600 mb-4">Belajar pemrograman, web development, mobile apps, dan teknologi terkini</p>
                        <ul class="space-y-2 text-sm text-gray-600 mb-4">
                            <li><i class="fas fa-check text-primary mr-2"></i>Web Programming</li>
                            <li><i class="fas fa-check text-primary mr-2"></i>Mobile Development</li>
                            <li><i class="fas fa-check text-primary mr-2"></i>Database Management</li>
                        </ul>
                        <a href="{{ route('daftar') }}" class="inline-block text-primary font-semibold hover:text-secondary transition">
                            Pelajari Lebih Lanjut <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Jurusan 2 -->
                <div class="jurusan-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=800&q=80" alt="TKJ" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent opacity-70"></div>
                        <div class="absolute bottom-4 left-4">
                            <i class="fas fa-network-wired text-white text-3xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl font-bold mb-3 text-gray-800">Teknik Komputer & Jaringan</h4>
                        <p class="text-gray-600 mb-4">Ahli dalam instalasi, maintenance, dan troubleshooting jaringan komputer</p>
                        <ul class="space-y-2 text-sm text-gray-600 mb-4">
                            <li><i class="fas fa-check text-primary mr-2"></i>Network Administration</li>
                            <li><i class="fas fa-check text-primary mr-2"></i>Server Management</li>
                            <li><i class="fas fa-check text-primary mr-2"></i>Cyber Security</li>
                        </ul>
                        <a href="{{ route('daftar') }}" class="inline-block text-primary font-semibold hover:text-secondary transition">
                            Pelajari Lebih Lanjut <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Jurusan 3 -->
                <div class="jurusan-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=800&q=80" alt="MM" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent opacity-70"></div>
                        <div class="absolute bottom-4 left-4">
                            <i class="fas fa-video text-white text-3xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl font-bold mb-3 text-gray-800">Multimedia</h4>
                        <p class="text-gray-600 mb-4">Kreativitas bertemu teknologi dalam desain grafis, video, dan animasi</p>
                        <ul class="space-y-2 text-sm text-gray-600 mb-4">
                            <li><i class="fas fa-check text-primary mr-2"></i>Graphic Design</li>
                            <li><i class="fas fa-check text-primary mr-2"></i>Video Editing</li>
                            <li><i class="fas fa-check text-primary mr-2"></i>3D Animation</li>
                        </ul>
                        <a href="{{ route('daftar') }}" class="inline-block text-primary font-semibold hover:text-secondary transition">
                            Pelajari Lebih Lanjut <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Jurusan 4 -->
                <div class="jurusan-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=800&q=80" alt="OTKP" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent opacity-70"></div>
                        <div class="absolute bottom-4 left-4">
                            <i class="fas fa-building text-white text-3xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl font-bold mb-3 text-gray-800">Otomasi Tata Kelola Perkantoran</h4>
                        <p class="text-gray-600 mb-4">Profesional dalam administrasi dan manajemen perkantoran modern</p>
                        <ul class="space-y-2 text-sm text-gray-600 mb-4">
                            <li><i class="fas fa-check text-primary mr-2"></i>Office Administration</li>
                            <li><i class="fas fa-check text-primary mr-2"></i>Business Communication</li>
                            <li><i class="fas fa-check text-primary mr-2"></i>Digital Documentation</li>
                        </ul>
                        <a href="{{ route('daftar') }}" class="inline-block text-primary font-semibold hover:text-secondary transition">
                            Pelajari Lebih Lanjut <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Jurusan 5 -->
                <div class="jurusan-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=800&q=80" alt="AKL" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent opacity-70"></div>
                        <div class="absolute bottom-4 left-4">
                            <i class="fas fa-calculator text-white text-3xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl font-bold mb-3 text-gray-800">Akuntansi & Keuangan Lembaga</h4>
                        <p class="text-gray-600 mb-4">Ahli keuangan yang kompeten dalam akuntansi dan perpajakan</p>
                        <ul class="space-y-2 text-sm text-gray-600 mb-4">
                            <li><i class="fas fa-check text-primary mr-2"></i>Financial Accounting</li>
                            <li><i class="fas fa-check text-primary mr-2"></i>Tax Management</li>
                            <li><i class="fas fa-check text-primary mr-2"></i>Computerized Accounting</li>
                        </ul>
                        <a href="{{ route('daftar') }}" class="inline-block text-primary font-semibold hover:text-secondary transition">
                            Pelajari Lebih Lanjut <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Jurusan 6 -->
                <div class="jurusan-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1581092583537-20d51b4b4f1b?auto=format&fit=crop&w=800&q=80" alt="BDP" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent opacity-70"></div>
                        <div class="absolute bottom-4 left-4">
                            <i class="fas fa-shopping-cart text-white text-3xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl font-bold mb-3 text-gray-800">Bisnis Digital & Pemasaran</h4>
                        <p class="text-gray-600 mb-4">Mahir dalam e-commerce, digital marketing, dan entrepreneurship</p>
                        <ul class="space-y-2 text-sm text-gray-600 mb-4">
                            <li><i class="fas fa-check text-primary mr-2"></i>Digital Marketing</li>
                            <li><i class="fas fa-check text-primary mr-2"></i>E-Commerce</li>
                            <li><i class="fas fa-check text-primary mr-2"></i>Social Media Strategy</li>
                        </ul>
                        <a href="{{ route('daftar') }}" class="inline-block text-primary font-semibold hover:text-secondary transition">
                            Pelajari Lebih Lanjut <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FASILITAS SECTION -->
    <section id="fasilitas" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Fasilitas</span>
                <h3 class="text-4xl font-bold mt-4 mb-4 text-gray-800">Fasilitas Lengkap & Modern</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">Didukung dengan sarana dan prasarana yang memadai untuk menunjang pembelajaran</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="facility-card group">
                    <div class="bg-gradient-to-br from-primary to-secondary p-6 rounded-2xl text-white text-center transform group-hover:scale-105 transition-transform duration-300 shadow-lg">
                        <i class="fas fa-flask text-5xl mb-4"></i>
                        <h4 class="text-xl font-bold mb-2">Laboratorium Komputer</h4>
                        <p class="text-green-100 text-sm">50+ unit PC terbaru</p>
                    </div>
                </div>
                <div class="facility-card group">
                    <div class="bg-gradient-to-br from-secondary to-primary p-6 rounded-2xl text-white text-center transform group-hover:scale-105 transition-transform duration-300 shadow-lg">
                        <i class="fas fa-book text-5xl mb-4"></i>
                        <h4 class="text-xl font-bold mb-2">Perpustakaan Digital</h4>
                        <p class="text-green-100 text-sm">10.000+ koleksi buku</p>
                    </div>
                </div>
                <div class="facility-card group">
                    <div class="bg-gradient-to-br from-primary to-secondary p-6 rounded-2xl text-white text-center transform group-hover:scale-105 transition-transform duration-300 shadow-lg">
                        <i class="fas fa-wifi text-5xl mb-4"></i>
                        <h4 class="text-xl font-bold mb-2">WiFi Gratis</h4>
                        <p class="text-green-100 text-sm">Akses internet cepat</p>
                    </div>
                </div>
                <div class="facility-card group">
                    <div class="bg-gradient-to-br from-secondary to-primary p-6 rounded-2xl text-white text-center transform group-hover:scale-105 transition-transform duration-300 shadow-lg">
                        <i class="fas fa-running text-5xl mb-4"></i>
                        <h4 class="text-xl font-bold mb-2">Lapangan Olahraga</h4>
                        <p class="text-green-100 text-sm">Basket, Futsal, Voli</p>
                    </div>
                </div>
                <div class="facility-card group">
                    <div class="bg-gradient-to-br from-primary to-secondary p-6 rounded-2xl text-white text-center transform group-hover:scale-105 transition-transform duration-300 shadow-lg">
                        <i class="fas fa-utensils text-5xl mb-4"></i>
                        <h4 class="text-xl font-bold mb-2">Kantin Modern</h4>
                        <p class="text-green-100 text-sm">Menu sehat & bervariasi</p>
                    </div>
                </div>
                <div class="facility-card group">
                    <div class="bg-gradient-to-br from-secondary to-primary p-6 rounded-2xl text-white text-center transform group-hover:scale-105 transition-transform duration-300 shadow-lg">
                        <i class="fas fa-mosque text-5xl mb-4"></i>
                        <h4 class="text-xl font-bold mb-2">Musholla</h4>
                        <p class="text-green-100 text-sm">Tempat ibadah nyaman</p>
                    </div>
                </div>
                <div class="facility-card group">
                    <div class="bg-gradient-to-br from-primary to-secondary p-6 rounded-2xl text-white text-center transform group-hover:scale-105 transition-transform duration-300 shadow-lg">
                        <i class="fas fa-car text-5xl mb-4"></i>
                        <h4 class="text-xl font-bold mb-2">Parkir Luas</h4>
                        <p class="text-green-100 text-sm">Aman & terorganisir</p>
                    </div>
                </div>
                <div class="facility-card group">
                    <div class="bg-gradient-to-br from-secondary to-primary p-6 rounded-2xl text-white text-center transform group-hover:scale-105 transition-transform duration-300 shadow-lg">
                        <i class="fas fa-medkit text-5xl mb-4"></i>
                        <h4 class="text-xl font-bold mb-2">Ruang UKS</h4>
                        <p class="text-green-100 text-sm">Layanan kesehatan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- PRESTASI SECTION -->
<section id="prestasi" class="py-20 bg-gradient-to-br from-primary to-secondary">
    <div class="max-w-7xl mx-auto px-4">

        <!-- Judul & Stats -->
        <div class="text-center mb-16 text-white">
            <span class="font-semibold text-sm uppercase tracking-wider text-green-200">Prestasi</span>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-10">
                <div class="stat-item text-center">
                    <i class="fas fa-user-graduate text-5xl mb-4"></i>
                    <h3 class="text-4xl font-bold counter" data-target="1500">0</h3>
                    <p class="text-green-100 mt-2">Siswa Aktif</p>
                </div>

                <div class="stat-item text-center">
                    <i class="fas fa-chalkboard-teacher text-5xl mb-4"></i>
                    <h3 class="text-4xl font-bold counter" data-target="75">0</h3>
                    <p class="text-green-100 mt-2">Guru & Staff</p>
                </div>

                <div class="stat-item text-center">
                    <i class="fas fa-trophy text-5xl mb-4"></i>
                    <h3 class="text-4xl font-bold counter" data-target="120">0</h3>
                    <p class="text-green-100 mt-2">Prestasi</p>
                </div>

                <div class="stat-item text-center">
                    <i class="fas fa-briefcase text-5xl mb-4"></i>
                    <h3 class="text-4xl font-bold counter" data-target="95">0</h3>
                    <p class="text-green-100 mt-2">% Terserap Kerja</p>
                </div>
            </div>
        </div>

        <!-- Badge Title -->
        <div class="text-center text-white mb-10">
            <i class="fas fa-users text-5xl mb-4"></i>
            <h3 class="text-4xl font-bold mt-4 mb-4">Segudang Prestasi Membanggakan</h3>
            <p class="text-green-100 max-w-2xl mx-auto">
                Bukti nyata dedikasi dan kerja keras siswa-siswi kami
            </p>
        </div>

        <!-- List Prestasi -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white/10 backdrop-blur-lg p-6 rounded-2xl border border-white/20 hover:bg-white/20 transition">
                <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-trophy text-white text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold text-white mb-2">Juara 1 LKS Nasional</h4>
                <p class="text-green-100">Web Technology 2024</p>
            </div>

            <div class="bg-white/10 backdrop-blur-lg p-6 rounded-2xl border border-white/20 hover:bg-white/20 transition">
                <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-medal text-white text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold text-white mb-2">Juara 2 Olimpiade Sains</h4>
                <p class="text-green-100">Tingkat Provinsi 2024</p>
            </div>

            <div class="bg-white/10 backdrop-blur-lg p-6 rounded-2xl border border-white/20 hover:bg-white/20 transition">
                <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-award text-white text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold text-white mb-2">Best Startup</h4>
                <p class="text-green-100">Kompetisi Bisnis Siswa 2024</p>
            </div>

            <div class="bg-white/10 backdrop-blur-lg p-6 rounded-2xl border border-white/20 hover:bg-white/20 transition">
                <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-futbol text-white text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold text-white mb-2">Juara Futsal</h4>
                <p class="text-green-100">Piala SMK Cup 2023</p>
            </div>

            <div class="bg-white/10 backdrop-blur-lg p-6 rounded-2xl border border-white/20 hover:bg-white/20 transition">
                <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-laptop-code text-white text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold text-white mb-2">Hackathon Champion</h4>
                <p class="text-green-100">Tech Innovation 2024</p>
            </div>

            <div class="bg-white/10 backdrop-blur-lg p-6 rounded-2xl border border-white/20 hover:bg-white/20 transition">
                <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-palette text-white text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold text-white mb-2">Juara Desain Grafis</h4>
                <p class="text-green-100">Kompetisi Kreativitas 2024</p>
            </div>
        </div>

    </div>
</section>

    <!-- GALERI SECTION -->
    <section id="galeri" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Galeri</span>
                <h3 class="text-4xl font-bold mt-4 mb-4 text-gray-800">Dokumentasi Kegiatan</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">Momen berharga dari berbagai kegiatan dan acara di sekolah</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="gallery-item relative overflow-hidden rounded-2xl h-64 group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?auto=format&fit=crop&w=800&q=80" alt="Kegiatan 1" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent opacity-0 group-hover:opacity-90 transition-opacity flex items-end p-6">
                        <div class="text-white">
                            <h4 class="text-xl font-bold mb-2">Kegiatan Pembelajaran</h4>
                            <p class="text-green-200">Praktik di laboratorium komputer</p>
                        </div>
                    </div>
                </div>
                <div class="gallery-item relative overflow-hidden rounded-2xl h-64 group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80" alt="Kegiatan 2" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent opacity-0 group-hover:opacity-90 transition-opacity flex items-end p-6">
                        <div class="text-white">
                            <h4 class="text-xl font-bold mb-2">Wisuda Siswa</h4>
                            <p class="text-green-200">Kelulusan angkatan 2024</p>
                        </div>
                    </div>
                </div>
                <div class="gallery-item relative overflow-hidden rounded-2xl h-64 group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80" alt="Kegiatan 3" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent opacity-0 group-hover:opacity-90 transition-opacity flex items-end p-6">
                        <div class="text-white">
                            <h4 class="text-xl font-bold mb-2">Lomba Kompetisi</h4>
                            <p class="text-green-200">Tim robotik sekolah</p>
                        </div>
                    </div>
                </div>
                <div class="gallery-item relative overflow-hidden rounded-2xl h-64 group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80" alt="Kegiatan 4" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent opacity-0 group-hover:opacity-90 transition-opacity flex items-end p-6">
                        <div class="text-white">
                            <h4 class="text-xl font-bold mb-2">Seminar Industri</h4>
                            <p class="text-green-200">Kolaborasi dengan perusahaan</p>
                        </div>
                    </div>
                </div>
                <div class="gallery-item relative overflow-hidden rounded-2xl h-64 group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=800&q=80" alt="Kegiatan 5" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent opacity-0 group-hover:opacity-90 transition-opacity flex items-end p-6">
                        <div class="text-white">
                            <h4 class="text-xl font-bold mb-2">Study Tour</h4>
                            <p class="text-green-200">Kunjungan industri</p>
                        </div>
                    </div>
                </div>
                <div class="gallery-item relative overflow-hidden rounded-2xl h-64 group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=80" alt="Kegiatan 6" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent opacity-0 group-hover:opacity-90 transition-opacity flex items-end p-6">
                        <div class="text-white">
                            <h4 class="text-xl font-bold mb-2">Acara Sekolah</h4>
                            <p class="text-green-200">Perayaan hari besar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BIAYA SECTION -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Biaya Pendidikan</span>
                <h3 class="text-4xl font-bold mt-4 mb-4 text-gray-800">Investasi Terbaik Masa Depan</h3>
                <p class="text-gray-600">Biaya terjangkau dengan kualitas terbaik</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-gradient-to-br from-primary to-secondary p-8 rounded-2xl text-white shadow-2xl transform hover:scale-105 transition">
                    <div class="text-center">
                        <i class="fas fa-file-invoice text-5xl mb-4"></i>
                        <h4 class="text-2xl font-bold mb-4">Biaya Pendaftaran</h4>
                        <div class="text-5xl font-bold mb-2">Rp 2.500.000</div>
                        <p class="text-green-100 mb-6">Pembayaran satu kali</p>
                        <ul class="text-left space-y-2 text-green-100">
                            <li><i class="fas fa-check-circle mr-2"></i>Formulir pendaftaran</li>
                            <li><i class="fas fa-check-circle mr-2"></i>Seragam lengkap</li>
                            <li><i class="fas fa-check-circle mr-2"></i>Buku paket</li>
                            <li><i class="fas fa-check-circle mr-2"></i>ID Card & Kartu Perpustakaan</li>
                        </ul>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-secondary to-primary p-8 rounded-2xl text-white shadow-2xl transform hover:scale-105 transition">
                    <div class="text-center">
                        <i class="fas fa-calendar-alt text-5xl mb-4"></i>
                        <h4 class="text-2xl font-bold mb-4">SPP Bulanan</h4>
                        <div class="text-5xl font-bold mb-2">Rp 750.000</div>
                        <p class="text-green-100 mb-6">Per bulan</p>
                        <ul class="text-left space-y-2 text-green-100">
                            <li><i class="fas fa-check-circle mr-2"></i>Kegiatan belajar mengajar</li>
                            <li><i class="fas fa-check-circle mr-2"></i>Akses fasilitas sekolah</li>
                            <li><i class="fas fa-check-circle mr-2"></i>Ekstrakurikuler</li>
                            <li><i class="fas fa-check-circle mr-2"></i>Asuransi siswa</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-green-50 border-l-4 border-primary p-6 rounded-lg">
                <div class="flex">
                    <i class="fas fa-info-circle text-primary text-2xl mr-4"></i>
                    <div>
                        <h5 class="font-bold text-gray-800 mb-2">Informasi Tambahan</h5>
                        <p class="text-gray-600">Tersedia program beasiswa prestasi dan keringanan biaya bagi siswa berprestasi atau kurang mampu. Hubungi kami untuk informasi lebih lanjut.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIAL SECTION -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Testimoni</span>
                <h3 class="text-4xl font-bold mt-4 mb-4 text-gray-800">Kata Alumni & Orang Tua</h3>
                <p class="text-gray-600">Pengalaman nyata dari mereka yang telah bergabung</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80" alt="Alumni" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h5 class="font-bold text-gray-800">Budi Santoso</h5>
                            <p class="text-sm text-gray-600">Alumni RPL 2020</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600">"Setelah lulus, saya langsung diterima kerja di perusahaan IT ternama. Berkat ilmu yang didapat di SMK ini, saya siap menghadapi dunia kerja."</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=200&q=80" alt="Alumni" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h5 class="font-bold text-gray-800">Siti Nurhaliza</h5>
                            <p class="text-sm text-gray-600">Alumni Multimedia 2021</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600">"Guru-guru yang kompeten dan fasilitas yang memadai membuat saya berkembang pesat. Sekarang saya bekerja sebagai desainer grafis profesional."</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80" alt="Orang Tua" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h5 class="font-bold text-gray-800">Pak Ahmad</h5>
                            <p class="text-sm text-gray-600">Orang Tua Siswa</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600">"Saya sangat puas dengan perkembangan anak saya di sekolah ini. Karakternya terbentuk baik dan skill-nya terus meningkat."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTAK & PENDAFTARAN SECTION -->
    <section id="kontak" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Info Kontak -->
                <div>
                    <span class="text-primary font-semibold text-sm uppercase tracking-wider">Hubungi Kami</span>
                    <h3 class="text-4xl font-bold mt-4 mb-6 text-gray-800">Informasi Kontak</h3>
                    <p class="text-gray-600 mb-8">Jangan ragu untuk menghubungi kami jika ada pertanyaan atau ingin berkonsultasi</p>

                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800 mb-1">Alamat</h5>
                                <p class="text-gray-600">Jl. Pendidikan No. 123, Bekasi Timur<br>Kota Bekasi, Jawa Barat 17113</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-white text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800 mb-1">Telepon</h5>
                                <p class="text-gray-600">(021) 8888-9999<br>0812-3456-7890</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-white text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800 mb-1">Email</h5>
                                <p class="text-gray-600">info@smkteknologi.sch.id<br>ppdb@smkteknologi.sch.id</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clock text-white text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800 mb-1">Jam Operasional</h5>
                                <p class="text-gray-600">Senin - Jumat: 07.00 - 16.00<br>Sabtu: 07.00 - 12.00</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-primary hover:bg-secondary rounded-lg flex items-center justify-center text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-primary hover:bg-secondary rounded-lg flex items-center justify-center text-white transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-primary hover:bg-secondary rounded-lg flex items-center justify-center text-white transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-primary hover:bg-secondary rounded-lg flex items-center justify-center text-white transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Form Pendaftaran
                <div id="daftar" class="bg-gradient-to-br from-primary to-secondary p-8 rounded-3xl shadow-2xl">
                    <h3 class="text-3xl font-bold text-white mb-6">Daftar Sekarang</h3>
                    <p class="text-green-100 mb-6">Isi form di bawah ini dan tim kami akan segera menghubungi Anda</p>

                    <div id="form-container">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-white font-semibold mb-2">Nama Lengkap <span class="text-yellow-300">*</span></label>
                                <input type="text" id="nama" class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-white outline-none" placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div>
                                <label class="block text-white font-semibold mb-2">NIK <span class="text-yellow-300">*</span></label>
                                <input type="text" id="nik" class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-white outline-none" placeholder="16 digit NIK" required>
                            </div>

                            <div>
                                <label class="block text-white font-semibold mb-2">Email <span class="text-yellow-300">*</span></label>
                                <input type="email" id="email" class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-white outline-none" placeholder="email@example.com" required>
                            </div>

                            <div>
                                <label class="block text-white font-semibold mb-2">No. WhatsApp <span class="text-yellow-300">*</span></label>
                                <input type="tel" id="hp" class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-white outline-none" placeholder="08xxxxxxxxxx" required>
                            </div>

                            <div>
                                <label class="block text-white font-semibold mb-2">Jurusan Pilihan <span class="text-yellow-300">*</span></label>
                                <select id="jurusan" class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-white outline-none" required>
                                    <option value="">Pilih Jurusan</option>
                                    <option value="rpl">Rekayasa Perangkat Lunak</option>
                                    <option value="tkj">Teknik Komputer & Jaringan</option>
                                    <option value="mm">Multimedia</option>
                                    <option value="otkp">Otomasi Tata Kelola Perkantoran</option>
                                    <option value="akl">Akuntansi & Keuangan Lembaga</option>
                                    <option value="bdp">Bisnis Digital & Pemasaran</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-white font-semibold mb-2">Upload Dokumen</label>
                                <p class="text-sm text-green-100 mb-2">Ijazah SMP, Kartu Keluarga, Akta Kelahiran (PDF/JPG, max 5MB)</p>
                                <input type="file" id="dokumen" class="w-full px-4 py-3 rounded-lg bg-white focus:ring-2 focus:ring-white outline-none" multiple accept=".pdf,.jpg,.jpeg,.png">
                            </div>

                            <button type="button" onclick="submitForm()" class="w-full bg-white text-primary font-bold py-4 rounded-lg hover:bg-green-50 transition transform hover:scale-105 shadow-lg">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Pendaftaran
                            </button>
                        </div>

                        <div id="success-message" class="hidden mt-6 bg-white/20 backdrop-blur-lg border-2 border-white/50 p-6 rounded-lg text-center">
                            <i class="fas fa-check-circle text-white text-5xl mb-4"></i>
                            <h4 class="text-2xl font-bold text-white mb-2">Pendaftaran Berhasil!</h4>
                            <p class="text-green-100">Terima kasih telah mendaftar. Tim kami akan segera menghubungi Anda.</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <!-- MAP SECTION -->
    <section id="lokasi" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Lokasi</span>
                <h3 class="text-4xl font-bold mt-4 mb-4 text-gray-800">Temukan Kami</h3>
                <p class="text-gray-600">SMK Teknologi Nusantara - Bekasi Timur</p>
            </div>

            <div class="rounded-3xl overflow-hidden shadow-2xl">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126846.10058021855!2d106.99017!3d-6.2382698!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698d4c0534c6b3%3A0x48d3e855b5f6!2sBekasi%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1234567890" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gradient-to-br from-dark to-primary text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-primary text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold">SMK Teknologi</h4>
                            <p class="text-xs text-green-200">Nusantara</p>
                        </div>
                    </div>
                    <p class="text-green-100 text-sm">Membangun generasi unggul dengan pendidikan vokasi berkualitas tinggi untuk masa depan Indonesia.</p>
                </div>

                <div>
                    <h5 class="font-bold mb-4 text-lg">Link Cepat</h5>
                    <ul class="space-y-2 text-green-100">
                        <li><a href="#tentang" class="hover:text-white transition"><i class="fas fa-chevron-right text-xs mr-2"></i>Tentang Kami</a></li>
                        <li><a href="#jurusan" class="hover:text-white transition"><i class="fas fa-chevron-right text-xs mr-2"></i>Jurusan</a></li>
                        <li><a href="#fasilitas" class="hover:text-white transition"><i class="fas fa-chevron-right text-xs mr-2"></i>Fasilitas</a></li>
                        <li><a href="#prestasi" class="hover:text-white transition"><i class="fas fa-chevron-right text-xs mr-2"></i>Prestasi</a></li>
                        <li><a href="{{ route('daftar') }}" class="hover:text-white transition"><i class="fas fa-chevron-right text-xs mr-2"></i>Pendaftaran</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-bold mb-4 text-lg">Program</h5>
                    <ul class="space-y-2 text-green-100 text-sm">
                        <li><i class="fas fa-laptop-code text-secondary mr-2"></i>Rekayasa Perangkat Lunak</li>
                        <li><i class="fas fa-network-wired text-secondary mr-2"></i>Teknik Komputer & Jaringan</li>
                        <li><i class="fas fa-video text-secondary mr-2"></i>Multimedia</li>
                        <li><i class="fas fa-building text-secondary mr-2"></i>OTKP</li>
                        <li><i class="fas fa-calculator text-secondary mr-2"></i>Akuntansi</li>
                        <li><i class="fas fa-shopping-cart text-secondary mr-2"></i>Bisnis Digital</li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-bold mb-4 text-lg">Newsletter</h5>
                    <p class="text-green-100 text-sm mb-4">Dapatkan informasi terbaru seputar pendaftaran dan kegiatan sekolah</p>
                    <div class="flex">
                        <input type="email" placeholder="Email Anda" class="flex-1 px-4 py-2 rounded-l-lg text-gray-800 focus:outline-none">
                        <button class="bg-secondary hover:bg-primary px-4 py-2 rounded-r-lg transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="border-t border-green-700 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-green-100 text-sm mb-4 md:mb-0">&copy; 2025 SMK Teknologi Nusantara. All Rights Reserved.</p>
                <div class="flex space-x-6 text-sm text-green-100">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                    <a href="#" class="hover:text-white transition">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- SCROLL TO TOP BUTTON -->
    <button id="scroll-top" class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-br from-primary to-secondary text-white rounded-full shadow-lg hover:shadow-2xl transition-all transform hover:scale-110 hidden z-40">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Custom JS -->
    <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>