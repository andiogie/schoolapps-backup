# Blueprint Aplikasi Sekolah

## Ringkasan

Aplikasi ini adalah sistem informasi sekolah yang komprehensif, dibangun dengan framework Laravel. Aplikasi ini bertujuan untuk mendigitalkan dan menyederhanakan berbagai proses administrasi dan akademik di sekolah, mulai dari pendaftaran siswa baru, manajemen data master, hingga ke modul-modul spesifik seperti absensi dan rapor.

*Generated with AI assistance to accelerate development.*

## Desain & Fitur

### Fitur Utama

#### 1. Manajemen Data Master (Khusus Admin)

*   **CRUD Guru, Siswa, Mapel, Kelas, Jurusan, Tahun Ajaran, Jadwal Pelajaran.**
*   **Manajemen Profil Sekolah:** Admin dapat mengubah detail profil sekolah.
*   **Manajemen Fasilitas (Fitur Baru):**
    *   Admin dapat mengelola data fasilitas sekolah.
    *   Operasi yang tersedia adalah Create, Read, dan Update (tanpa Delete).
    *   Setiap fasilitas memiliki status aktif (`is_active`) yang bisa diubah.
    *   Tersedia input melalui form web dan endpoint API.
    *   Semua perubahan (create/update) akan dicatat dalam audit trail.

#### 2. Modul Guru, Siswa, Kepala Sekolah, dan Pendaftaran Publik

*   Fungsionalitas yang sudah ada tetap dipertahankan, seperti dashboard, manajemen absensi, tugas, materi, rapor, profil, dan persetujuan izin.

#### 3. Halaman Publik

*   Akan dibuat halaman publik baru (`/fasilitas`) untuk menampilkan semua fasilitas yang berstatus aktif.

## Rencana Perubahan Saat Ini

**Tugas:** Implementasi Fitur Manajemen Fasilitas.

*   **[SELESAI]** Memperbarui `blueprint.md` untuk mencatat rencana fitur baru.
*   **[AKAN DATANG]** Membuat migrasi database untuk tabel `fasilitas`.
*   **[AKAN DATANG]** Membuat Model `Fasilitas`.
*   **[AKAN DATANG]** Membuat `FasilitasController` untuk web dan API, termasuk integrasi logging.
*   **[AKAN DATANG]** Menambahkan rute untuk web dan API.
*   **[AKAN DATANG]** Membuat file-file view (index, create, edit) untuk admin.
*   **[AKAN DATANG]** Menambahkan menu "Fasilitas" di sidebar admin.
*   **[AKAN DATANG]** Membuat halaman publik untuk menampilkan fasilitas aktif.
