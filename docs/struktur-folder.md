# 📁 Struktur Folder School Management System
Dokumentasi ini menjelaskan struktur folder utama dalam aplikasi **School Management System**, yang dirancang agar scalable, rapi, dan mudah dikembangkan.

---

## 1. /auth
Berisi semua proses otentikasi untuk seluruh user (admin, guru, siswa, kepala sekolah, operator, TU).
/auth
    /login              DONE
    /logout
    /register      <-- opsional (jika hanya admin yang buat akun, hapus folder ini)
    /forgot-password    DONE (belum ada OTP reset password)

## 2. /dashboard
Setiap role memiliki dashboard masing-masing.  
Redirect setelah login akan membawa user ke dashboard sesuai role.
/dashboard
    /admin
    /kepsek
    /guru
    /operator
    /tu            <-- tata usaha
    /siswa

## 3. /master (Master Data)
Berisi data inti yang dipakai di banyak modul.  
Semua role yang butuh akses data ini akan mengambil dari modul master.
/master
    /kelas
    /mapel
    /tahun-ajaran
    /jurusan
    /ruangan

## 4. /akademik
Modul utama kegiatan akademik sekolah.
/akademik
    /nilai
    /absensi
    /raport
    /jadwal
    /ujian
    /kbm              <-- kegiatan belajar mengajar

## 5. /users (User Management)
Modul untuk mengelola pengguna, role, dan permission.
/users
    /list
    /roles
    /permissions

## 6. /sarpras (Sarana Prasarana) – Opsional
Untuk manajemen aset & inventaris sekolah.
/sarpras
    /inventaris
    /peminjaman
    /pengembalian

## 7. /laporan
Semua laporan sekolah dari berbagai modul.
/laporan
    /nilai
    /absensi
    /kehadiran-guru
    /rekap

## 8. /assets
Aset front-end seperti CSS, JavaScript, gambar, font, dll.
/assets
    /img
    /css
    /js
    /fonts

## 9. /components
Komponen UI reusable seperti navbar, sidebar, widget, dll.
/components
    /navbar
    /sidebar
    /header
    /footer
    /widgets

## 10. /config dan /helpers
Konfigurasi aplikasi & helper function yang sering digunakan.
/config
/helpers
    /date
    /file
    /auth
    /response

---

# 🎯 Catatan Tambahan
- Semua role login di `/auth/login`.
- Setelah login, sistem membaca role user, lalu otomatis redirect.
- Struktur ini cocok dipakai pada Laravel, Node.js, Express, Next, atau framework apa pun.

---

# ✔ File ini disimpan di:
/docs/struktur-folder.md


