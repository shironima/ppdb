<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Diterima - PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #28a745;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            color: #333333;
            line-height: 1.6;
        }
        .email-body p {
            margin: 0 0 10px;
        }
        .email-body a {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
        }
        .email-footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #666666;
        }
        .email-footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>Selamat, Pendaftaran Anda Diterima!</h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p>Halo {{ $user->calonSiswa->nama_lengkap }},</p>
            <p>Terima kasih telah mendaftar di SMAK Santo Bonaventura. Pendaftaran Anda telah berhasil kami terima dan sedang dalam proses verifikasi.</p>
            <p>Anda dapat memantau status pendaftaran Anda melalui tautan berikut:</p>
            <p><a href="{{ route('status-pendaftaran.index') }}">Lihat Status Pendaftaran</a></p>
            <p>Jika ada pertanyaan, jangan ragu untuk menghubungi kami melalui <a href="{{ route('siswa.informasi-ppdb.tanya-admin-ppdb') }}">Tanya Admin</a>, Email atau WhatsApp yang tersedia.</p>
            <p>Salam hangat,<br>Tim PPDB</p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>PPDB Online | <a href="#">Kunjungi Situs</a></p>
        </div>
    </div>
</body>
</html>
