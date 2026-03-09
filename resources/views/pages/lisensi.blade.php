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

@section('title', 'Lisensi Penggunaan')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Lisensi dan Ketentuan Penggunaan</h6>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">

                    <div class="mb-4">
                        <h4>Pemberitahuan Hak Cipta</h4>
                        <p>Hak cipta © {{ date('Y') }} <strong>Andi Putra Ogie</strong>. Semua hak dilindungi undang-undang.</p>
                        <p>Seluruh konten, kode sumber, desain, dan aset intelektual yang terkandung dalam aplikasi "Sistem Informasi Sekolah" ini adalah milik eksklusif dari pengembang, kecuali dinyatakan lain. Penggunaan, reproduksi, atau distribusi tanpa izin tertulis dari pemegang hak cipta adalah dilarang.</p>
                    </div>

                    <div class="mb-4">
                        <h4>Ketentuan Penggunaan</h4>
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item border-0 ps-0">
                                <strong>Penggunaan yang Diizinkan:</strong> Aplikasi ini diberikan lisensinya kepada sekolah yang telah secara resmi terdaftar dan disetujui oleh administrator untuk tujuan operasional dan kegiatan belajar mengajar internal.
                            </li>
                            <li class="list-group-item border-0 ps-0">
                                <strong>Larangan:</strong> Pengguna dilarang keras untuk melakukan rekayasa balik (reverse engineering), dekompilasi, menyalin, memodifikasi, mendistribusikan ulang, atau menyewakan aplikasi ini dalam bentuk apa pun tanpa persetujuan eksplisit dari pengembang.
                            </li>
                            <li class="list-group-item border-0 ps-0">
                                <strong>Tanggung Jawab Pengguna:</strong> Setiap pengguna (admin, guru, siswa) bertanggung jawab untuk menjaga kerahasiaan kredensial akunnya dan bertanggung jawab atas semua aktivitas yang terjadi di bawah akun tersebut.
                            </li>
                            <li class="list-group-item border-0 ps-0">
                                <strong>Batasan Tanggung Jawab:</strong> Aplikasi ini disediakan "sebagaimana adanya" tanpa jaminan apa pun. Pengembang tidak bertanggung jawab atas kehilangan data, kerusakan, atau kerugian lain yang timbul dari penggunaan atau ketidakmampuan untuk menggunakan aplikasi ini.
                            </li>
                        </ol>
                    </div>

                    <hr class="horizontal dark my-4">

                    <p class="text-sm">Dengan menggunakan aplikasi ini, Anda dianggap telah membaca, memahami, dan menyetujui seluruh ketentuan yang tercantum dalam lisensi ini. Pelanggaran terhadap ketentuan ini dapat dikenakan sanksi sesuai hukum yang berlaku.</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
