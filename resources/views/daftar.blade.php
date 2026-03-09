
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pendaftaran Siswa Baru - Sekolah Impian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
        }
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.4);
        }
        .step-item.active .step-circle { background-color: #3b82f6; color: white; }
        .step-item.active .step-title { color: #3b82f6; font-weight: 700; }
        .step-item.completed .step-circle { background-color: #10b981; color: white; }
        .step-item.completed .step-title { color: #10b981; }
        .step-item .step-line { background-color: #4b5563; }
        .step-item.completed .step-line { background-color: #10b981; }
        .form-step {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .summary-grid { display: grid; grid-template-columns: auto 1fr; gap: 0.5rem 1rem; }
        .summary-label { font-weight: 600; color: #4b5563; text-align: right; }
        .summary-value { color: #1f2937; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-6xl mx-auto bg-white rounded-2xl shadow-2xl flex flex-col lg:flex-row">

            <!-- Sidebar / Progress Bar -->
            <div class="w-full lg:w-1/3 bg-slate-800 text-white p-8 rounded-t-2xl lg:rounded-l-2xl lg:rounded-tr-none">
                <div class="flex items-center space-x-3 mb-10">
                    <i class="fas fa-school-flag text-3xl text-blue-400"></i>
                    <div>
                        <h1 class="text-2xl font-bold">Sekolah Impian</h1>
                        <p class="text-sm text-slate-300">Pendaftaran Siswa Baru</p>
                    </div>
                </div>

                <div class="space-y-8 relative">
                    <!-- Step 1 -->
                    <div id="step-indicator-1" class="step-item flex items-center relative active">
                        <div class="step-circle w-10 h-10 rounded-full bg-slate-600 flex items-center justify-center text-lg font-bold transition-all">1</div>
                        <div class="ml-4">
                            <h3 class="step-title text-lg font-semibold text-slate-400">Data Diri Siswa</h3>
                        </div>
                        <div class="step-line h-full w-0.5 absolute left-5 top-12"></div>
                    </div>
                    <!-- Step 2 -->
                    <div id="step-indicator-2" class="step-item flex items-center relative">
                        <div class="step-circle w-10 h-10 rounded-full bg-slate-600 flex items-center justify-center text-lg font-bold transition-all">2</div>
                        <div class="ml-4">
                            <h3 class="step-title text-lg font-semibold text-slate-400">Data Orang Tua</h3>
                        </div>
                        <div class="step-line h-full w-0.5 absolute left-5 top-12"></div>
                    </div>
                    <!-- Step 3 -->
                    <div id="step-indicator-3" class="step-item flex items-center relative">
                        <div class="step-circle w-10 h-10 rounded-full bg-slate-600 flex items-center justify-center text-lg font-bold transition-all">3</div>
                        <div class="ml-4">
                            <h3 class="step-title text-lg font-semibold text-slate-400">Pilihan Jurusan</h3>
                        </div>
                        <div class="step-line h-full w-0.5 absolute left-5 top-12"></div>
                    </div>
                    <!-- Step 4 -->
                    <div id="step-indicator-4" class="step-item flex items-center relative">
                        <div class="step-circle w-10 h-10 rounded-full bg-slate-600 flex items-center justify-center text-lg font-bold transition-all">4</div>
                        <div class="ml-4">
                            <h3 class="step-title text-lg font-semibold text-slate-400">Konfirmasi</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="w-full lg:w-2/3 p-8 lg:p-12">
                <form id="registration-form" method="POST" action="{{ route('daftar.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Step 1: Data Diri -->
                    <div id="step-1" class="form-step">
                        <h2 class="text-3xl font-bold mb-2">Informasi Pribadi Siswa</h2>
                        <p class="text-slate-600 mb-8">Lengkapi setiap kolom dengan data yang valid dan benar.</p>
                        <div class="grid md:grid-cols-2 gap-x-6 gap-y-4">
                            <div class="md:col-span-2">
                                <label for="nama_lengkap" class="font-semibold">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" required class="form-input mt-1" placeholder="Contoh: John Doe">
                            </div>
                            <div>
                                <label for="tempat_lahir" class="font-semibold">Tempat Lahir <span class="text-red-500">*</span></label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" required class="form-input mt-1" placeholder="Contoh: Jakarta">
                            </div>
                            <div>
                                <label for="tanggal_lahir" class="font-semibold">Tanggal Lahir <span class="text-red-500">*</span></label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" required class="form-input mt-1">
                            </div>
                            <div>
                                <label for="jenis_kelamin" class="font-semibold">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <select name="jenis_kelamin" id="jenis_kelamin" required class="form-input mt-1">
                                    <option value="">Pilih satu...</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label for="agama" class="font-semibold">Agama <span class="text-red-500">*</span></label>
                                <select name="agama" id="agama" required class="form-input mt-1">
                                    <option value="">Pilih Agama</option>
                                    <option>Islam</option><option>Kristen</option><option>Katolik</option><option>Hindu</option><option>Buddha</option><option>Lainnya</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label for="alamat" class="font-semibold">Alamat Lengkap <span class="text-red-500">*</span></label>
                                <textarea name="alamat" id="alamat" required class="form-input mt-1" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                            </div>
                             <div>
                                <label for="no_hp" class="font-semibold">No. HP/WhatsApp <span class="text-red-500">*</span></label>
                                <input type="tel" name="no_hp" id="no_hp" required class="form-input mt-1" placeholder="08xxxx">
                            </div>
                            <div>
                                <label for="email" class="font-semibold">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" id="email" required class="form-input mt-1" placeholder="email@anda.com">
                            </div>
                        </div>
                        <div class="flex justify-between mt-10">
                            <a href="{{ url('/') }}" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition"><i class="fas fa-home mr-2"></i>Kembali ke Beranda</a>
                            <button type="button" onclick="nextStep()" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition">Berikutnya <i class="fas fa-arrow-right ml-2"></i></button>
                        </div>
                    </div>

                    <!-- Step 2: Data Orang Tua -->
                    <div id="step-2" class="form-step hidden">
                        <h2 class="text-3xl font-bold mb-2">Informasi Keluarga</h2>
                        <p class="text-slate-600 mb-8">Pastikan Nomor KK valid untuk proses verifikasi.</p>
                        <div class="grid md:grid-cols-2 gap-x-6 gap-y-4">
                           <div class="md:col-span-2">
                               <label for="nomor_kk" class="font-semibold">Nomor Kartu Keluarga (KK) <span class="text-red-500">*</span></label>
                                <input type="text" name="nomor_kk" id="nomor_kk" required class="form-input mt-1" placeholder="16 digit nomor KK" maxlength="16">
                           </div>
                           <div class="md:col-span-2 font-bold text-lg text-slate-700 border-b pb-2 mb-2 pt-4">Data Ayah</div>
                           <div>
                                <label for="nama_ayah" class="font-semibold">Nama Ayah <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_ayah" id="nama_ayah" required class="form-input mt-1">
                            </div>
                            <div>
                                <label for="pekerjaan_ayah" class="font-semibold">Pekerjaan Ayah <span class="text-red-500">*</span></label>
                                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" required class="form-input mt-1">
                            </div>

                           <div class="md:col-span-2 font-bold text-lg text-slate-700 border-b pb-2 mb-2 mt-4">Data Ibu</div>
                            <div>
                                <label for="nama_ibu" class="font-semibold">Nama Ibu <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_ibu" id="nama_ibu" required class="form-input mt-1">
                            </div>
                            <div>
                                <label for="pekerjaan_ibu" class="font-semibold">Pekerjaan Ibu <span class="text-red-500">*</span></label>
                                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" required class="form-input mt-1">
                            </div>

                            <div class="md:col-span-2 font-bold text-lg text-slate-700 border-b pb-2 mb-2 mt-4">Kontak Wali</div>
                             <div>
                                <label for="no_hp_ortu" class="font-semibold">No. HP Orang Tua <span class="text-red-500">*</span></label>
                                <input type="tel" name="no_hp_ortu" id="no_hp_ortu" required class="form-input mt-1" placeholder="Kontak yang bisa dihubungi">
                            </div>
                        </div>
                        <div class="flex justify-between mt-10">
                            <button type="button" onclick="prevStep()" class="px-8 py-3 bg-slate-200 text-slate-700 font-bold rounded-lg hover:bg-slate-300 transition"><i class="fas fa-arrow-left mr-2"></i>Kembali</button>
                            <button type="button" onclick="nextStep()" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition">Berikutnya <i class="fas fa-arrow-right ml-2"></i></button>
                        </div>
                    </div>

                    <!-- Step 3: Pilihan Jurusan -->
                    <div id="step-3" class="form-step hidden">
                        <h2 class="text-3xl font-bold mb-2">Pilihan Program Studi</h2>
                        <p class="text-slate-600 mb-8">Pilih jurusan yang paling sesuai dengan minat dan bakat Anda.</p>
                        <div class="space-y-4">
                            <div>
                                <label for="asal_sekolah" class="font-semibold">Asal Sekolah <span class="text-red-500">*</span></label>
                                <input type="text" name="asal_sekolah" id="asal_sekolah" required class="form-input mt-1" placeholder="Nama SMP/MTs asal">
                            </div>
                            <div>
                                <label for="jurusan" class="font-semibold">Pilihan Jurusan <span class="text-red-500">*</span></label>
                                <select name="jurusan" id="jurusan" required class="form-input mt-1">
                                    <option value="">Pilih Jurusan</option>
                                    <option value="RPL">Rekayasa Perangkat Lunak</option>
                                    <option value="TKJ">Teknik Komputer & Jaringan</option>
                                    <option value="DKV">Desain Komunikasi Visual</option>
                                    <option value="AKL">Akuntansi & Keuangan Lembaga</option>
                                </select>
                            </div>
                             <div class="pt-6">
                                <label class="font-semibold">Dokumen Pendukung <span class="text-red-500">*</span></label>
                                <p class="text-slate-600 text-sm mb-2">Upload Ijazah/Surat Kelulusan dalam format PDF atau JPG (max 2MB).</p>
                                <input type="file" name="ijazah" id="ijazah" required class="form-input">
                            </div>
                        </div>

                        <div class="flex justify-between mt-10">
                            <button type="button" onclick="prevStep()" class="px-8 py-3 bg-slate-200 text-slate-700 font-bold rounded-lg hover:bg-slate-300 transition"><i class="fas fa-arrow-left mr-2"></i>Kembali</button>
                            <button type="button" onclick="nextStep()" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition">Lanjut ke Konfirmasi <i class="fas fa-arrow-right ml-2"></i></button>
                        </div>
                    </div>

                    <!-- Step 4: Konfirmasi -->
                    <div id="step-4" class="form-step hidden">
                        <h2 class="text-3xl font-bold mb-2">Konfirmasi Data Pendaftaran</h2>
                        <p class="text-slate-600 mb-8">Mohon periksa kembali semua data Anda sebelum mengirim. Pastikan tidak ada kesalahan penulisan.</p>
                        
                        <div class="space-y-6">
                            <!-- Data Diri -->
                            <div>
                                <h3 class="text-xl font-bold text-slate-700 border-b pb-2 mb-4">Data Diri Siswa</h3>
                                <div class="summary-grid">
                                    <span class="summary-label">Nama Lengkap:</span> <span id="konfirmasi-nama_lengkap" class="summary-value"></span>
                                    <span class="summary-label">TTL:</span> <span id="konfirmasi-ttl" class="summary-value"></span>
                                    <span class="summary-label">Jenis Kelamin:</span> <span id="konfirmasi-jenis_kelamin" class="summary-value"></span>
                                    <span class="summary-label">Agama:</span> <span id="konfirmasi-agama" class="summary-value"></span>
                                    <span class="summary-label">Alamat:</span> <span id="konfirmasi-alamat" class="summary-value"></span>
                                    <span class="summary-label">No. HP:</span> <span id="konfirmasi-no_hp" class="summary-value"></span>
                                    <span class="summary-label">Email:</span> <span id="konfirmasi-email" class="summary-value"></span>
                                </div>
                            </div>

                            <!-- Data Ortu -->
                             <div>
                                <h3 class="text-xl font-bold text-slate-700 border-b pb-2 mb-4">Data Keluarga</h3>
                                <div class="summary-grid">
                                    <span class="summary-label">No. KK:</span> <span id="konfirmasi-nomor_kk" class="summary-value"></span>
                                    <span class="summary-label">Nama Ayah:</span> <span id="konfirmasi-nama_ayah" class="summary-value"></span>
                                    <span class="summary-label">Nama Ibu:</span> <span id="konfirmasi-nama_ibu" class="summary-value"></span>
                                    <span class="summary-label">No. HP Ortu:</span> <span id="konfirmasi-no_hp_ortu" class="summary-value"></span>
                                </div>
                            </div>

                            <!-- Data Sekolah & Jurusan -->
                             <div>
                                <h3 class="text-xl font-bold text-slate-700 border-b pb-2 mb-4">Pilihan Akademik</h3>
                                <div class="summary-grid">
                                    <span class="summary-label">Asal Sekolah:</span> <span id="konfirmasi-asal_sekolah" class="summary-value"></span>
                                    <span class="summary-label">Jurusan:</span> <span id="konfirmasi-jurusan" class="summary-value"></span>
                                    <span class="summary-label">Dokumen:</span> <span id="konfirmasi-ijazah" class="summary-value"></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-start">
                                <!-- *** FIX: Added name="pernyataan" *** -->
                                <input type="checkbox" id="pernyataan" name="pernyataan" required class="w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-blue-500 mt-1">
                                <label for="pernyataan" class="ml-3 text-sm text-slate-700">
                                    Saya menyatakan bahwa seluruh data yang diisikan adalah benar dan siap bertanggung jawab atas keabsahan data tersebut.
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-between mt-10">
                            <button type="button" onclick="prevStep()" class="px-8 py-3 bg-slate-200 text-slate-700 font-bold rounded-lg hover:bg-slate-300 transition"><i class="fas fa-arrow-left mr-2"></i>Kembali</button>
                            <button type="submit" id="submit-btn" class="px-8 py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition"><i class="fas fa-check-circle mr-2"></i>Kirim Pendaftaran</button>
                        </div>
                    </div>

                </form>
                
                <!-- Success State -->
                <div id="success-message" class="hidden text-center">
                    <div class="w-24 h-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-party-horn text-5xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-800 mb-3">Pendaftaran Terkirim!</h2>
                    <p class="text-slate-600 mb-4">
                        Terima kasih! Data pendaftaran Anda dengan nomor <strong id="nomor-pendaftaran" class="text-blue-600"></strong> telah kami terima. 
                    </p>
                    <p class="text-slate-600">
                        Tim kami akan melakukan verifikasi dan menghubungi Anda dalam 2x24 jam melalui email atau WhatsApp.
                    </p>
                    <a href="{{ url('/') }}" class="mt-8 inline-block px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('js/register.js') }}"></script>
</body>
</html>
