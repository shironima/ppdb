@extends('layouts.app')

@section('title', 'Biaya Pendidikan')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 fw-bold">Biaya Pendidikan</h1>
    <p class="text-center text-muted fs-5 mb-5">
        Rincian biaya pendidikan di SMAK Santo Bonaventura*
    </p>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Uang Masuk -->
            <h4 class="fw-bold mb-3">Uang Masuk (dibayar sekali saat daftar ulang)</h4>
            <table class="table table-striped table-bordered">
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

            <!-- Biaya Lainnya -->
            <h4 class="fw-bold mt-5 mb-3">Biaya Lainnya (dibayar berkala)</h4>
            <table class="table table-striped table-bordered">
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
                        <td>Biaya Ekstrakurikuler**</td>
                        <td class="text-end">Rp 150.000,-</td>
                    </tr>
                    <tr>
                        <td>Biaya Ujian**</td>
                        <td class="text-end">Rp 300.000,-</td>
                    </tr>
                    <tr>
                        <td>Sarana Prasarana**</td>
                        <td class="text-end">Rp 300.000,-</td>
                    </tr>
                </tbody>
            </table>

            <p class="mt-4 text-muted">
                <small>*Biaya dapat berubah sewaktu-waktu sesuai dengan kebijakan sekolah. Untuk informasi lebih lanjut, hubungi pihak sekolah.</small>
                <br>
                <small>**Dibayarkan per semester.</small>
            </p>
        </div>
    </div>
</div>
@endsection
