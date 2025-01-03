<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perubahan Status Pendaftaran - PPDB</title>
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
            background-color: #17a2b8;
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
        .congratulations-message {
            background-color: #28a745;
            color: white;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>
                @if($registration->status === 'accepted')
                    SELAMAT! ANDA DITERIMA SEBAGAI SISWA SMAK SANTO BONAVENTURA
                @else
                    Perubahan Status Pendaftaran
                @endif
            </h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p>Halo {{ $user->calonSiswa->nama_lengkap }},</p>

            @if($registration->status === 'accepted')
                <div class="congratulations-message">
                    Selamat! Anda telah diterima sebagai siswa SMAK Santo Bonaventura.
                </div>
            @else
                <p>Status pendaftaran Anda telah berubah menjadi: <strong>{{ ucfirst($registration->status) }}</strong>.</p>
            @endif

            @if($registration->komentar)
                <p>Komentar: {{ $registration->komentar }}</p>
            @else
                <p>Tidak ada komentar dari admin.</p>
            @endif

            <p>Silakan cek status pendaftaran Anda di dashboard untuk informasi lebih lanjut.</p>
            <p>Terima kasih,</p>
            <p>Tim PPDB SMAK Santo Bonaventura</p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>PPDB Online | <a href="#">Kunjungi Situs</a></p>
        </div>
    </div>
</body>
</html>
