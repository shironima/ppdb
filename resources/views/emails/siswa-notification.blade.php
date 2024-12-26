<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Diterima - PPDB</title>
</head>
<body>
    <h1>Selamat, Pendaftaran Anda Telah Diterima!</h1>
    <p>Halo {{ $user->calonSiswa->nama_lengkap }},</p>
    <p>Terima kasih telah mendaftar di PPDB kami. Pendaftaran Anda telah berhasil kami terima dan akan segera diproses lebih lanjut.</p>
    <p>Pastikan Anda memantau status pendaftaran Anda di halaman <a href="{{ route('status-pendaftaran.index') }}">Status Pendaftaran</a>.</p>
    <p>Jika ada pertanyaan, Anda dapat menghubungi kami melalui email atau WhatsApp yang terdaftar.</p>
    <p>Salam,<br>Tim PPDB</p>
</body>
</html>
