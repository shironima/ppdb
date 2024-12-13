@extends('siswa.layouts.siswa-layout')

@section('title', 'Biaya Pendidikan')

@section('content')
<div class="pagetitle">
    <h1>Biaya Pendidikan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Biaya Pendidikan</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Rincian Biaya Pendidikan</h5>
                    <p class="text-muted">
                        Selamat datang di halaman informasi biaya pendidikan SMAK Santo Bonaventura Madiun. Berikut adalah rincian biaya yang perlu dipenuhi:
                    </p>

                    <div class="accordion" id="biayaAccordion">
                        <!-- Uang Masuk -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingMasuk">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMasuk" aria-expanded="true" aria-controls="collapseMasuk">
                                    Uang Masuk
                                </button>
                            </h2>
                            <div id="collapseMasuk" class="accordion-collapse collapse show" aria-labelledby="headingMasuk" data-bs-parent="#biayaAccordion">
                                <div class="accordion-body">
                                    <table class="table table-hover table-bordered shadow-sm">
                                        <thead class="bg-primary text-white text-center">
                                            <tr>
                                                <th>Komponen</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Uang Pangkal</td>
                                                <td class="text-end">Rp 5.000.000,-</td>
                                            </tr>
                                            <tr>
                                                <td>Seragam dan Atribut</td>
                                                <td class="text-end">Rp 1.500.000,-</td>
                                            </tr>
                                            <tr>
                                                <td>Buku dan Modul (tahun pertama)</td>
                                                <td class="text-end">Rp 1.000.000,-</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="fw-bold text-center">Total Uang Masuk</td>
                                                <td class="fw-bold text-end">Rp 7.500.000,-</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Biaya Lainnya -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingLainnya">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLainnya" aria-expanded="false" aria-controls="collapseLainnya">
                                    Biaya Lainnya
                                </button>
                            </h2>
                            <div id="collapseLainnya" class="accordion-collapse collapse" aria-labelledby="headingLainnya" data-bs-parent="#biayaAccordion">
                                <div class="accordion-body">
                                    <table class="table table-hover table-bordered shadow-sm">
                                        <thead class="bg-primary text-white text-center">
                                            <tr>
                                                <th>Komponen</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>SPP Bulanan</td>
                                                <td class="text-end">Rp 200.000,-</td>
                                            </tr>
                                            <tr>
                                                <td>Biaya Ekstrakurikuler</td>
                                                <td class="text-end">Rp 150.000,-</td>
                                            </tr>
                                            <tr>
                                                <td>Biaya Ujian</td>
                                                <td class="text-end">Rp 300.000,-</td>
                                            </tr>
                                            <tr>
                                                <td>Sarana Prasarana</td>
                                                <td class="text-end">Rp 300.000,-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4">
                        Untuk informasi lebih lanjut, silakan kunjungi <a href="/" class="text-decoration-none fw-bold">halaman utama</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
