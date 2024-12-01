@extends('siswa.layouts.siswa-layout')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">
        <!-- Card Example -->
        <div class="col-lg-4 col-md-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Welcome</h5>
                    <p>Hello, <strong>{{ Auth::user()->name }}</strong>! You are successfully logged in.</p>
                </div>
            </div>
        </div>

        <!-- Card Data Diri -->
        <div class="col-lg-4 col-md-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Data Diri</h5>
                    @php
                        $calonSiswa = auth()->user()->calonSiswa;
                    @endphp
                    @if ($calonSiswa)
                        <p>Data diri kamu sudah lengkap!</p>
                        <a href="{{ route('calon-siswa.show') }}" class="btn btn-primary">Lihat Data Diri</a>
                    @else
                        <p>Data diri belum diisi.</p>
                        <a href="{{ route('calon-siswa.create') }}" class="btn btn-warning">Lengkapi Sekarang</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
