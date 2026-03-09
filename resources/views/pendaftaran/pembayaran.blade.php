<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Konfirmasi Pembayaran Pendaftaran</h3>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="alert alert-info">
                            Silakan lakukan pembayaran dan unggah bukti transfer Anda di sini.
                        </div>

                        <h5>Detail Pendaftar:</h5>
                        <p><strong>No. Pendaftaran:</strong> {{ $pendaftaran->no_pendaftaran }}</p>
                        <p><strong>Nama Lengkap:</strong> {{ $pendaftaran->nama_lengkap }}</p>
                        
                        <hr>

                        <h5>Detail Biaya:</h5>
                        <p><strong>Total Biaya Pendaftaran:</strong> Rp {{ number_format($pendaftaran->total_biaya, 2, ',', '.') }}</p>
                        <p><strong>Sudah Dibayar:</strong> Rp {{ number_format($pendaftaran->total_bayar, 2, ',', '.') }}</p>
                        <p><strong>Sisa Pembayaran:</strong> Rp {{ number_format($pendaftaran->total_biaya - $pendaftaran->total_bayar, 2, ',', '.') }}</p>
                        
                        <hr>

                        <form action="{{ route('pendaftaran.process_payment', ['no_pendaftaran' => $pendaftaran->no_pendaftaran]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="jumlah_bayar" class="form-label">Jumlah yang Dibayarkan</label>
                                <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror" id="jumlah_bayar" name="jumlah_bayar" required>
                                @error('jumlah_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bukti_pembayaran" class="form-label">Unggah Bukti Pembayaran</label>
                                <input type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror" id="bukti_pembayaran" name="bukti_pembayaran" required>
                                <div class="form-text">Format file: PDF, JPG, PNG (maks. 2MB)</div>
                                @error('bukti_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Kirim Bukti Pembayaran</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
