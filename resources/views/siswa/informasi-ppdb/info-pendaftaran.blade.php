@extends('siswa.layouts.siswa-layout')

@section('title', 'Informasi PPDB')

@section('content')
<div class="pagetitle">
    <h1>Informasi PPDB</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Informasi PPDB</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Penerimaan Peserta Didik Baru (PPDB)</h5>
                    <p class="text-muted">
                        Selamat datang di halaman Informasi PPDB SMAK Santo Bonaventura Madiun. Berikut adalah rincian proses, jadwal, dan persyaratan yang perlu dipenuhi:
                    </p>

                    <div class="accordion" id="ppdbAccordion">
                        <!-- Proses Pendaftaran -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingProses">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProses" aria-expanded="true" aria-controls="collapseProses">
                                    Proses Pendaftaran
                                </button>
                            </h2>
                            <div id="collapseProses" class="accordion-collapse collapse show" aria-labelledby="headingProses" data-bs-parent="#ppdbAccordion">
                                <div class="accordion-body">
                                    Pendaftaran dilakukan secara <strong>online</strong> melalui sistem PPDB kami. Pastikan mengisi semua data dengan benar.
                                </div>
                            </div>
                        </div>

                        <!-- Jadwal Pendaftaran -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingJadwal">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseJadwal" aria-expanded="false" aria-controls="collapseJadwal">
                                    Jadwal Pendaftaran
                                </button>
                            </h2>
                            <div id="collapseJadwal" class="accordion-collapse collapse" aria-labelledby="headingJadwal" data-bs-parent="#ppdbAccordion">
                                <div class="accordion-body">
                                    Pendaftaran dibuka dari <span class="badge bg-success">1 Januari</span> hingga <span class="badge bg-danger">31 Mei</span> setiap tahun ajaran.
                                </div>
                            </div>
                        </div>

                        <!-- Persyaratan Berkas -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingBerkas">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBerkas" aria-expanded="false" aria-controls="collapseBerkas">
                                    Persyaratan Berkas
                                </button>
                            </h2>
                            <div id="collapseBerkas" class="accordion-collapse collapse" aria-labelledby="headingBerkas" data-bs-parent="#ppdbAccordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Scan Ijazah atau Surat Keterangan Lulus</li>
                                        <li>Scan Kartu Keluarga</li>
                                        <li>Scan Raport Semester 1 sampai 5</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Syarat Pendaftaran -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSyarat">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSyarat" aria-expanded="false" aria-controls="collapseSyarat">
                                    Syarat Pendaftaran
                                </button>
                            </h2>
                            <div id="collapseSyarat" class="accordion-collapse collapse" aria-labelledby="headingSyarat" data-bs-parent="#ppdbAccordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Usia minimal 15 tahun pada tanggal 1 Juli tahun ajaran berjalan</li>
                                        <li>Lulus SMP/MTs atau sederajat</li>
                                        <li>Sehat jasmani dan rohani (surat keterangan dokter)</li>
                                        <li>Nilai rata-rata minimal 70 pada mata pelajaran utama</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Biaya Pendaftaran -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingBiaya">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBiaya" aria-expanded="false" aria-controls="collapseBiaya">
                                    Biaya Pendaftaran
                                </button>
                            </h2>
                            <div id="collapseBiaya" class="accordion-collapse collapse" aria-labelledby="headingBiaya" data-bs-parent="#ppdbAccordion">
                                <div class="accordion-body">
                                    <span class="badge bg-warning text-dark">Rp 150.000,-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kontak -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingKontak">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKontak" aria-expanded="false" aria-controls="collapseKontak">
                                    Kontak Panitia
                                </button>
                            </h2>
                            <div id="collapseKontak" class="accordion-collapse collapse" aria-labelledby="headingKontak" data-bs-parent="#ppdbAccordion">
                                <div class="accordion-body">
                                    Hubungi kami melalui <a href="https://wa.me/6285159932501" class="text-decoration-none">WhatsApp</a> atau email: 
                                    <a href="mailto:info.ppdb@smabona.sch.id" class="text-decoration-none">info.ppdb@smabona.sch.id</a>.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4">
                        Untuk informasi lebih lanjut, silakan kunjungi 
                        <a href="/" class="text-decoration-none fw-bold">halaman utama</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection