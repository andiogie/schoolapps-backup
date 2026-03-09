<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru - SMK Teknologi Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
<body class="bg-gray-50">

    <!-- Header -->
    <header class="bg-gradient-to-r from-primary to-secondary text-white py-6 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-primary text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">SMK Teknologi Nusantara</h1>
                        <p class="text-sm text-green-100">Pendaftaran Siswa Baru</p>
                    </div>
                </div>
                <a href="{{ url('/') }}" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto px-4 py-8">
        
        <!-- Progress Steps -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center">
                        <div id="step-1-indicator" class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold transition-all">
                            1
                        </div>
                        <div class="flex-1 h-1 bg-primary mx-2"></div>
                    </div>
                    <p class="text-sm font-semibold text-primary mt-2">Data Diri</p>
                </div>
                
                <div class="flex-1">
                    <div class="flex items-center">
                        <div id="step-2-indicator" class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold transition-all">
                            2
                        </div>
                        <div id="line-2" class="flex-1 h-1 bg-gray-300 mx-2"></div>
                    </div>
                    <p id="step-2-text" class="text-sm font-semibold text-gray-400 mt-2">Data Orang Tua</p>
                </div>
                
                <div class="flex-1">
                    <div class="flex items-center">
                        <div id="step-3-indicator" class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold transition-all">
                            3
                        </div>
                        <div id="line-3" class="flex-1 h-1 bg-gray-300 mx-2"></div>
                    </div>
                    <p id="step-3-text" class="text-sm font-semibold text-gray-400 mt-2">Upload Dokumen</p>
                </div>
                
                <div class="flex-1">
                    <div class="flex items-center">
                        <div id="step-4-indicator" class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold transition-all">
                            4
                        </div>
                    </div>
                    <p id="step-4-text" class="text-sm font-semibold text-gray-400 mt-2">Verifikasi</p>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <form id="registration-form" method="POST" action="{{ route('daftar.store') }}" enctype="multipart/form-data">
            @csrf
            
            <!-- Step 1: Data Diri -->
            <div id="step-1" class="form-step">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Data Diri Siswa</h2>
                        <p class="text-gray-600">Lengkapi data pribadi calon siswa dengan benar</p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                   placeholder="Masukkan nama lengkap">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tempat Lahir <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                   placeholder="Kota kelahiran">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_kelamin" id="jenis_kelamin" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Agama <span class="text-red-500">*</span>
                            </label>
                            <select name="agama" id="agama" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none">
                                <option value="">Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                No. HP/WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="no_hp" id="no_hp" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                   placeholder="08xxxxxxxxxx">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                   placeholder="email@example.com">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Asal Sekolah <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="asal_sekolah" id="asal_sekolah" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                   placeholder="Nama SMP/MTs">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <textarea name="alamat" id="alamat" required rows="3"
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                      placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kota"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jurusan Pilihan <span class="text-red-500">*</span>
                            </label>
                            <select name="jurusan" id="jurusan" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none">
                                <option value="">Pilih Jurusan</option>
                                <option value="RPL">Rekayasa Perangkat Lunak</option>
                                <option value="TKJ">Teknik Komputer & Jaringan</option>
                                <option value="MM">Multimedia</option>
                                <option value="OTKP">Otomasi Tata Kelola Perkantoran</option>
                                <option value="AKL">Akuntansi & Keuangan Lembaga</option>
                                <option value="BDP">Bisnis Digital & Pemasaran</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="button" onclick="nextStep(2)" 
                                class="bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white font-bold px-8 py-3 rounded-xl transition transform hover:scale-105 shadow-lg">
                            Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 2: Data Orang Tua -->
            <div id="step-2" class="form-step hidden">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Data Orang Tua/Wali</h2>
                        <p class="text-gray-600">Lengkapi data orang tua atau wali siswa</p>
                    </div>

                    <!-- Data Ayah -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b-2 border-primary">
                            <i class="fas fa-user mr-2 text-primary"></i>Data Ayah
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Ayah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_ayah" id="nama_ayah" required
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                       placeholder="Nama lengkap ayah">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    NIK Ayah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nik_ayah" id="nik_ayah" required maxlength="16"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                       placeholder="16 digit NIK">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Pekerjaan Ayah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" required
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                       placeholder="Pekerjaan ayah">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    No. HP Ayah <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="no_hp_ayah" id="no_hp_ayah" required
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                       placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                    </div>

                    <!-- Data Ibu -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b-2 border-primary">
                            <i class="fas fa-user mr-2 text-primary"></i>Data Ibu
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Ibu <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_ibu" id="nama_ibu" required
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                       placeholder="Nama lengkap ibu">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    NIK Ibu <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nik_ibu" id="nik_ibu" required maxlength="16"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                       placeholder="16 digit NIK">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Pekerjaan Ibu <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" required
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                       placeholder="Pekerjaan ibu">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    No. HP Ibu <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="no_hp_ibu" id="no_hp_ibu" required
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                                       placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                    </div>

                    <!-- Penghasilan Orang Tua -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b-2 border-primary">
                            <i class="fas fa-money-bill-wave mr-2 text-primary"></i>Penghasilan
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Penghasilan Orang Tua/Bulan <span class="text-red-500">*</span>
                                </label>
                                <select name="penghasilan" id="penghasilan" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition outline-none">
                                    <option value="">Pilih Range Penghasilan</option>
                                    <option value="< 1 Juta">< Rp 1.000.000</option>
                                    <option value="1-2 Juta">Rp 1.000.000 - Rp 2.000.000</option>
                                    <option value="2-5 Juta">Rp 2.000.000 - Rp 5.000.000</option>
                                    <option value="5-10 Juta">Rp 5.000.000 - Rp 10.000.000</option>
                                    <option value="> 10 Juta">> Rp 10.000.000</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" onclick="prevStep(1)" 
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold px-8 py-3 rounded-xl transition">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </button>
                        <button type="button" onclick="nextStep(3)" 
                                class="bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white font-bold px-8 py-3 rounded-xl transition transform hover:scale-105 shadow-lg">
                            Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 3: Upload Dokumen -->
            <div id="step-3" class="form-step hidden">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Upload Dokumen Pendukung</h2>
                        <p class="text-gray-600">Unggah dokumen yang diperlukan (Format: PDF/JPG, Max: 2MB per file)</p>
                    </div>

                    <div class="space-y-6">
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-primary transition">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                Ijazah SMP/Sederajat <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="ijazah" id="ijazah" required accept=".pdf,.jpg,.jpeg,.png"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary outline-none"
                                   onchange="previewFile(this, 'ijazah-preview')">
                            <p class="text-xs text-gray-500 mt-2">File ijazah atau surat keterangan lulus</p>
                            <div id="ijazah-preview" class="mt-3"></div>
                        </div>

                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-primary transition">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-id-card text-blue-500 mr-2"></i>
                                Kartu Keluarga <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="kk" id="kk" required accept=".pdf,.jpg,.jpeg,.png"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary outline-none"
                                   onchange="previewFile(this, 'kk-preview')">
                            <p class="text-xs text-gray-500 mt-2">Kartu Keluarga yang masih berlaku</p>
                            <div id="kk-preview" class="mt-3"></div>
                        </div>

                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-primary transition">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-certificate text-green-500 mr-2"></i>
                                Akta Kelahiran <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="akta" id="akta" required accept=".pdf,.jpg,.jpeg,.png"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary outline-none"
                                   onchange="previewFile(this, 'akta-preview')">
                            <p class="text-xs text-gray-500 mt-2">Akta kelahiran asli</p>
                            <div id="akta-preview" class="mt-3"></div>
                        </div>

                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-primary transition">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-camera text-purple-500 mr-2"></i>
                                Pas Foto 3x4 <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="foto" id="foto" required accept=".jpg,.jpeg,.png"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary outline-none"
                                   onchange="previewFile(this, 'foto-preview')">
                            <p class="text-xs text-gray-500 mt-2">Foto terbaru dengan latar belakang merah/biru</p>
                            <div id="foto-preview" class="mt-3"></div>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" onclick="prevStep(2)" 
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold px-8 py-3 rounded-xl transition">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </button>
                        <button type="button" onclick="nextStep(4)" 
                                class="bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white font-bold px-8 py-3 rounded-xl transition transform hover:scale-105 shadow-lg">
                            Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 4: Verifikasi Data -->
            <div id="step-4" class="form-step hidden">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Verifikasi Data</h2>
                        <p class="text-gray-600">Periksa kembali data yang telah Anda masukkan</p>
                    </div>

                    <!-- Data Diri Summary -->
                    <div class="mb-6 p-6 bg-gray-50 rounded-xl">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-user-circle text-primary mr-2"></i> Data Diri Siswa
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4 text-sm" id="summary-data-diri">
                            <!-- Will be filled by JavaScript -->
                        </div>
                    </div>

                    <!-- Data Orang Tua Summary -->
                    <div class="mb-6 p-6 bg-gray-50 rounded-xl">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-users text-primary mr-2"></i> Data Orang Tua
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4 text-sm" id="summary-ortu">
                            <!-- Will be filled by JavaScript -->
                        </div>
                    </div>

                    <!-- Dokumen Summary -->
                    <div class="mb-6 p-6 bg-gray-50 rounded-xl">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-folder-open text-primary mr-2"></i> Dokumen Terupload
                        </h3>
                        <div class="space-y-2 text-sm" id="summary-dokumen">
                            <!-- Will be filled by JavaScript -->
                        </div>
                    </div>

                    <!-- Pernyataan -->
                    <div class="mb-6 p-6 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                        <div class="flex items-start space-x-3">
                            <input type="checkbox" id="pernyataan" required class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary mt-1">
                            <label for="pernyataan" class="text-sm text-gray-700">
                                Saya menyatakan bahwa data yang saya isikan adalah <strong>benar dan dapat dipertanggungjawabkan</strong>. 
                                Apabila dikemudian hari ditemukan data yang tidak sesuai, saya bersedia menerima sanksi sesuai ketentuan yang berlaku.
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" onclick="prevStep(3)" 
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold px-8 py-3 rounded-xl transition">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </button>
                        <button type="submit" id="submit-btn"
                                class="bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white font-bold px-8 py-3 rounded-xl transition transform hover:scale-105 shadow-lg">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Pendaftaran
                        </button>
                    </div>
                </div>
            </div>

        </form>

        <!-- Success Modal -->
        <div id="success-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all">
                <div class="text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-green-500 text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Pendaftaran Berhasil!</h3>
                    <p class="text-gray-600 mb-6">
                        Data pendaftaran Anda telah berhasil dikirim. Tim kami akan segera memverifikasi dan menghubungi Anda melalui WhatsApp/Email yang terdaftar.
                    </p>
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-6 text-left">
                        <p class="text-sm text-gray-700">
                            <strong>No. Pendaftaran:</strong> <span id="no-pendaftaran" class="text-primary font-bold">PPDB-2025-XXXX</span><br>
                            <strong>Status:</strong> <span class="text-yellow-600 font-semibold">Menunggu Verifikasi</span>
                        </p>
                    </div>
                    <button onclick="window.location.href='{{ url('/') }}'" 
                            class="w-full bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white font-bold py-3 rounded-xl transition">
                        <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-dark to-primary text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-green-100">&copy; 2025 SMK Teknologi Nusantara. All Rights Reserved.</p>
            <p class="text-sm text-green-200 mt-2">Hubungi kami: (021) 8888-9999 | ppdb@smkteknologi.sch.id</p>
        </div>
    </footer>
<script src="{{ asset('js/register.js') }}"></script>
</body>
</html>