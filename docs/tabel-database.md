# 📚 Daftar Tabel Database (Total 30 Tabel)
Struktur tabel utama untuk aplikasi **School Management System**.

---

## 1. AUTH & ROLE MANAGEMENT

### 1. users
Menyimpan akun semua pengguna (admin, guru, siswa, kepsek, TU, operator).

### 2. roles
Daftar role (admin, guru, siswa, kepsek, operator, TU, dsb).

### 3. permissions
Daftar izin (jika ingin akses granular per modul).

### 4. role_user
Pivot: user bisa punya role lebih dari satu.

### 5. permission_role
Pivot: role terhubung dengan banyak permission.

### 6. password_resets
Token untuk reset password.

### 7. login_logs
Log login dan aktivitas login (opsional tapi sangat berguna).

---

## 2. MASTER DATA

### 8. kelas
Data kelas, misalnya X IPA 1, XII TKJ, dll.

### 9. jurusan
Data jurusan, seperti IPA, IPS, TKJ, RPL.

### 10. mapel
Daftar mata pelajaran.

### 11. ruangan
Daftar ruangan (Lab RPL, Lab Komputer, Kelas A1, dsb).

### 12. tahun_ajaran
Daftar tahun ajaran (2024/2025).

### 13. semester
Data semester (Ganjil / Genap).

### 14. rombel
Rombongan belajar (opsional; dipakai jika struktur sekolah detail).

---

## 3. AKADEMIK

### 15. jadwal_pelajaran
Jadwal pelajaran per guru, kelas, mapel.

### 16. kbm_log
Log kegiatan belajar mengajar per hari.

### 17. ujian
Header data ujian (UTS, UAS, UH, kuis).

### 18. ujian_soal
Daftar soal untuk ujian tertentu.

### 19. ujian_jawaban
Jawaban siswa untuk soal ujian.

### 20. nilai
Nilai siswa per mapel / tugas / ujian.

### 21. raport_header
Data meta untuk raport siswa (tahun ajaran, semester, wali kelas).

### 22. raport_detail
Data nilai raport per mapel.

### 23. absensi_siswa
Absensi harian siswa.

### 24. absensi_guru
Absensi guru (opsional tapi banyak dipakai).

---

## 4. DATA PROFIL PENGGUNA (DETAIL)

### 25. guru_profiles
Profil detail guru (NIP, jabatan, status, alamat, dll).

### 26. siswa_profiles
Profil detail siswa (NIS, NISN, kelas, jurusan, orang tua).

### 27. pegawai_profiles
Profil selain guru: Kepala sekolah, TU, operator.

---

## 5. SARANA & PRASARANA (SARPRAS)

### 28. inventaris
Data aset sekolah (barang, peralatan, elektronik).

### 29. peminjaman
Peminjaman aset oleh guru / siswa.

### 30. pengembalian
Pengembalian aset yang dipinjam.

---

# 📌 Total: 30 tabel
Set lengkap untuk sistem sekolah modern (SMK/SMA/SD/SMP).

