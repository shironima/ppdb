@extends('layouts.app')

@section('title', 'Informasi PPDB')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 fw-bold">Informasi Penerimaan Peserta Didik Baru (PPDB)</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <p class="fs-5 text-muted">
                        Selamat datang di halaman Informasi Penerimaan Peserta Didik Baru (PPDB). Berikut adalah informasi mengenai proses pendaftaran, jadwal, dan persyaratan yang perlu dipenuhi:
                    </p>

                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item">
                            <h6 class="mb-1 fw-bold">Proses Pendaftaran</h6>
                            <p class="mb-0">Pendaftaran dilakukan secara <strong>online</strong> melalui sistem PPDB yang tersedia.</p>
                        </li>
                        <li class="list-group-item">
                            <h6 class="mb-1 fw-bold">Jadwal Pendaftaran</h6>
                            <p class="mb-0">
                                Pendaftaran dibuka mulai tanggal <span class="badge bg-success">1 Januari</span> hingga 
                                <span class="badge bg-danger">31 Mei</span> setiap tahun ajaran.
                            </p>
                        </li>
                        <li class="list-group-item">
                            <h6 class="mb-1 fw-bold">Persyaratan Berkas</h6>
                            <ul class="ms-4">
                                <li>Ijazah / Surat Keterangan Lulus</li>
                                <li>Kartu Keluarga</li>
                                <li>Surat Keterangan Hasil Ujian Nasional (SKHUN)</li>
                                <li>Raport Semester 1-5</li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <h6 class="mb-1 fw-bold">Syarat Pendaftaran</h6>
                            <ul class="ms-4">
                                <li>Usia minimal 15 tahun pada tanggal 1 Juli tahun ajaran berjalan</li>
                                <li>Telah menyelesaikan pendidikan di tingkat SMP/MTs atau sederajat</li>
                                <li>Sehat jasmani dan rohani yang dibuktikan dengan surat keterangan dari dokter</li>
                                <li>Memiliki nilai rata-rata raport minimal 70 pada mata pelajaran utama : Bahasa Indonesia, Bahasa Inggris, Matematika</li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <h6 class="mb-1 fw-bold">Kontak Panitia</h6>
                            <p class="mb-0">Hubungi kami melalui <a href="https://wa.me/6282241182732" class="text-decoration-none">WhatsApp</a>.</p>
                        </li>
                    </ul>

                    <div class="alert alert-info text-center">
                        Untuk informasi lebih lanjut, kunjungi 
                        <a href="/" class="text-decoration-none fw-bold">halaman utama</a> atau hubungi kami melalui email: 
                        <a href="mailto:gabrielahensky.dev@gmail.com" class="text-decoration-none fw-bold">info.ppdb@smabona.sch.id</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
