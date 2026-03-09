<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Siswa - {{ $rapor->siswa->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
            font-family: 'Times New Roman', Times, serif;
        }
        .rapor-container {
            width: 100%;
            max-width: 800px;
            margin: 2rem auto;
        }
        .kop-container {
            display: flex; 
            align-items: center; 
            border-bottom: 3px solid black; 
            padding-bottom: 15px; 
            margin-bottom: 20px;
        }
        .kop-logo {
            flex-shrink: 0;
            margin-right: 20px;
        }
        .kop-text {
            flex-grow: 1;
            text-align: center;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .rapor-container {
                margin: 0;
                padding: 1cm;
                width: 100%;
                max-width: 100%;
                border: none;
            }
            @page { size: auto;  margin: 0mm; }
        }
    </style>
</head>
{{-- Menambahkan body onload="window.print()" untuk memicu dialog print --}}
<body onload="window.print()">

    <div class="rapor-container">
        {{-- KOP SURAT --}}
         <div class="kop-container">
            @if(isset($profilSekolah) && $profilSekolah->logo_path)
                <div class="kop-logo">
                    {{-- Gunakan path absolut atau URL publik untuk PDF --}}
                    <img src="{{ $profilSekolah->logo_path }}" alt="Logo Sekolah" style="max-height: 90px;">
                </div>
            @endif
            <div class="kop-text">
                <h4 class="fw-bold mb-1">LAPORAN HASIL BELAJAR SISWA</h4>
                <h5 class="fw-semibold mb-1">{{ $profilSekolah->nama_sekolah ?? 'NAMA SEKOLAH BELUM DIATUR' }}</h5>
                <p class="mb-0" style="font-size: 0.9rem;">{{ $profilSekolah->alamat ?? '' }}</p>
                <p class="mb-0" style="font-size: 0.8rem;">
                    @if(isset($profilSekolah)) 
                        Telp: {{ $profilSekolah->telepon }} | Email: {{ $profilSekolah->email }} | Website: {{ $profilSekolah->website }}
                    @endif
                </p>
            </div>
        </div>

        {{-- INFO --}}
        <div class="text-center mb-4">
             <p class="mb-0">Tahun Ajaran: <strong>{{ $rapor->tahunAjaran->tahun_ajaran }}</strong> | Semester: <strong>{{ ucfirst($rapor->semester) }}</strong></p>
        </div>

        {{-- INFO SISWA --}}
        <div class="row mb-4">
            <div class="col-6 mb-2"><strong>Nama Siswa:</strong> {{ $rapor->siswa->nama_siswa }}</div>
            <div class="col-6 mb-2"><strong>Kelas:</strong> {{ $rapor->siswa->kelas->nama_kelas }}</div>
            <div class="col-6 mb-2"><strong>NIS:</strong> {{ $rapor->siswa->nis }}</div>
            <div class="col-6 mb-2"><strong>Wali Kelas:</strong> {{ $rapor->waliKelas->nama }}</div>
        </div>

        {{-- TABEL NILAI --}}
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Mata Pelajaran</th>
                        <th class="text-center">Nilai Akhir</th>
                        <th>Deskripsi/Capaian Kompetensi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rapor->details as $index => $detail)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $detail->mapel->nama_mapel }}</td>
                            <td class="text-center fw-bold fs-5">{{ $detail->nilai ?? '-' }}</td>
                            <td>{{ $detail->deskripsi ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center py-5">Belum ada nilai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- DITAMBAHKAN: Ringkasan Akademik --}}
        <div class="row justify-content-end mb-4">
            <div class="col-md-6">
                 <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="fw-bold">Nilai Rata-rata</td>
                            <td class="text-center fw-bold fs-5">{{ $rapor->nilai_rata_rata }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Status Akademik</td>
                            <td class="text-center fw-bold fs-5">{{ $rapor->status_akademik }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- CATATAN WALI KELAS --}}
        <div class="mb-5">
            <h6 class="fw-bold">Catatan Wali Kelas:</h6>
            <div style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background-color: #f8f9fa;">
                <p class="mb-0 fst-italic">{{ $rapor->catatan_wali_kelas ?? 'Tidak ada catatan.' }}</p>
            </div>
        </div>

        {{-- TANDA TANGAN --}}
        <div style="width: 100%; margin-top: 50px; display: table;">
            <div style="display: table-row;">
                <div style="width: 50%; text-align: center; display: table-cell;">
                    <p>Mengetahui,</p>
                    <p style="margin-bottom: 70px;">Kepala Sekolah</p>
                    <p class="fw-bold mb-0">{{ $profilSekolah->nama_kepala_sekolah ?? '.........................' }}</p>
                    <hr style="width: 70%; margin-left: auto; margin-right: auto;">
                </div>
                <div style="width: 50%; text-align: center; display: table-cell;">
                    <p>&nbsp;</p>
                    <p style="margin-bottom: 70px;">Wali Kelas,</p>
                    <p class="fw-bold mb-0">{{ $rapor->waliKelas->nama }}</p>
                    <hr style="width: 70%; margin-left: auto; margin-right: auto;">
                    <p>NIP: {{ $rapor->waliKelas->nip ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
