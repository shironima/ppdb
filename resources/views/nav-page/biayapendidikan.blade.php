@extends('layouts.app')

@section('title', 'Biaya Pendidikan')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Biaya Pendidikan</h1>
    <p class="mt-4">Berikut adalah informasi biaya pendidikan untuk tahun ajaran 2024/2025:</p>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Komponen</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Uang Pangkal</td>
                <td>Rp 5.000.000,-</td>
            </tr>
            <tr>
                <td>SPP Bulanan</td>
                <td>Rp 500.000,-</td>
            </tr>
            <tr>
                <td>Seragam dan Atribut</td>
                <td>Rp 1.500.000,-</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
