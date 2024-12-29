<!DOCTYPE html>
<html>
<head>
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
            background-color: #007bff;
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
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>Notifikasi Pendaftaran Baru</h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p>Halo Admin,</p>
            <p>Pengguna baru telah mendaftar dengan informasi berikut:</p>
            <ul>
                <li><strong>Nama Lengkap:</strong> {{ $user->calonSiswa->nama_lengkap }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>No. WhatsApp:</strong> {{ $user->notificationContact->whatsapp }}</li>
            </ul>
            <p>Harap segera memverifikasi pendaftaran ini melalui sistem.</p>
            <p>Terima kasih atas perhatian Anda!</p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>PPDB Online | <a href="#">Kunjungi Sistem</a></p>
        </div>
    </div>
</body>
</html>

