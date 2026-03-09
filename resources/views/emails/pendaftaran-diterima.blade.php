<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Diterima</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Selamat, Pendaftaran Anda Diterima!</h2>
        </div>
        <div class="content">
            <p>Yth. <strong>{{ $pendaftaran->nama_lengkap }}</strong>,</p>
            <p>Dengan gembira kami memberitahukan bahwa pendaftaran Anda dengan nomor <strong>{{ $pendaftaran->no_pendaftaran }}</strong> di sekolah kami telah kami terima untuk jurusan <strong>{{ $pendaftaran->jurusan }}</strong>.</p>
            <p>Kami sangat antusias untuk menyambut Anda sebagai bagian dari komunitas sekolah kami. Informasi lebih lanjut mengenai daftar ulang, jadwal orientasi, dan langkah selanjutnya akan kami sampaikan dalam waktu dekat.</p>
            <p>Terima kasih atas kepercayaan Anda.</p>
            <br>
            <p>Hormat kami,</p>
            <p><strong>Panitia PPDB Sekolah</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Sekolah Kami. Semua hak cipta dilindungi.</p>
            <p>Ini adalah email yang dibuat secara otomatis, mohon untuk tidak membalas.</p>
        </div>
    </div>
</body>
</html>
