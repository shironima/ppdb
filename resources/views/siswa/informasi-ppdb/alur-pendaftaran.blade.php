@extends('siswa.layouts.siswa-layout')

@section('title', 'Alur Pendaftaran')

@section('content')
<div class="pagetitle">
    <h1>Alur Pendaftaran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Alur Pendaftaran</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Alur Pendaftaran SMAK Santo Bonaventura Madiun</h5>
                    <p class="text-muted">
                        Ikuti langkah-langkah berikut untuk mendaftar di SMAK Santo Bonaventura Madiun.
                    </p>

                    <div class="accordion" id="alurAccordion">
                        <!-- Langkah 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingLangkah1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLangkah1" aria-expanded="true" aria-controls="collapseLangkah1">
                                    Langkah 1: Kunjungi Halaman Pendaftaran Online
                                </button>
                            </h2>
                            <div id="collapseLangkah1" class="accordion-collapse collapse show" aria-labelledby="headingLangkah1" data-bs-parent="#alurAccordion">
                                <div class="accordion-body">
                                    Kunjungi halaman pendaftaran online di <a href="{{ route('/') }}" class="text-decoration-none text-primary fw-bold">Pendaftaran Online</a>. Baca <a href="{{ route('nav-page.informasippdb') }}" class="text-decoration-none text-secondary fw-bold">Informasi PPDB</a> sebelum memulai registrasi.
                                </div>
                            </div>
                        </div>

                        <!-- Langkah 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingLangkah2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLangkah2" aria-expanded="false" aria-controls="collapseLangkah2">
                                    Langkah 2: Buat Akun
                                </button>
                            </h2>
                            <div id="collapseLangkah2" class="accordion-collapse collapse" aria-labelledby="headingLangkah2" data-bs-parent="#alurAccordion">
                                <div class="accordion-body">
                                    Buat akun untuk dapat login ke dalam sistem.
                                </div>
                            </div>
                        </div>

                        <!-- Langkah 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingLangkah3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLangkah3" aria-expanded="false" aria-controls="collapseLangkah3">
                                    Langkah 3: Isi Formulir dan Upload Berkas
                                </button>
                            </h2>
                            <div id="collapseLangkah3" class="accordion-collapse collapse" aria-labelledby="headingLangkah3" data-bs-parent="#alurAccordion">
                                <div class="accordion-body">
                                    Isi semua formulir dan upload berkas yang dibutuhkan, seperti: Keterangan Lulus/Ijazah, Raport Semester 1-5, dan Kartu Keluarga.
                                </div>
                            </div>
                        </div>

                        <!-- Langkah 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingLangkah4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLangkah4" aria-expanded="false" aria-controls="collapseLangkah4">
                                    Langkah 4: Bayar Biaya Pendaftaran
                                </button>
                            </h2>
                            <div id="collapseLangkah4" class="accordion-collapse collapse" aria-labelledby="headingLangkah4" data-bs-parent="#alurAccordion">
                                <div class="accordion-body">
                                    Lakukan pembayaran biaya pendaftaran melalui rekening yang tersedia.
                                </div>
                            </div>
                        </div>

                        <!-- Langkah 5 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingLangkah5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLangkah5" aria-expanded="false" aria-controls="collapseLangkah5">
                                    Langkah 5: Tunggu Konfirmasi Sistem dan Admin
                                </button>
                            </h2>
                            <div id="collapseLangkah5" class="accordion-collapse collapse" aria-labelledby="headingLangkah5" data-bs-parent="#alurAccordion">
                                <div class="accordion-body">
                                    Tunggu konfirmasi formulir dan berkas dari sistem. Admin akan memverifikasi berkas pendaftaran dan mengirimkan hasilnya melalui Email dan WhatsApp.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4">
                        Masih ada yang ditanyakan? Silakan ajukan pertanyaan di halaman
                        <a href="{{ route('siswa.informasi-ppdb.tanya-admin-ppdb') }}" class="text-decoration-none fw-bold">Tanya pada Admin PPDB</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
