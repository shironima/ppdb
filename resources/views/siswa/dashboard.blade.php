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
                    <p>Hallo, <strong>{{ Auth::user()->name }}</strong>! Anda berhasil login.</p>
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
                        <div class="status-section">
                            <p>Status Saat Ini :
                            @if ($calonSiswa->status === 'Terverifikasi')
                                <span class="badge bg-success">Terverifikasi</span>
                            @elseif ($calonSiswa->status === 'Perlu Perbaikan')
                                <span class="badge bg-warning">Perlu Perbaikan</span>
                            @else
                                <span class="badge bg-secondary">Belum Terverifikasi</span>
                            @endif
                            </p>
                        </div>
                        <a href="{{ route('calon-siswa.index') }}" class="btn btn-primary mt-2">Lihat Data Diri</a>
                    @else
                        <p>Data diri belum diisi.</p>
                        <div class="status-section">
                            <span class="badge bg-warning">Perlu Perbaikan</span>
                        </div>
                        <a href="{{ route('calon-siswa.create') }}" class="btn btn-warning mt-2">Lengkapi Sekarang</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Card Alamat -->
        <div class="col-lg-4 col-md-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Alamat</h5>
                    @php
                        $alamat = auth()->user()->alamat;
                    @endphp
                    @if ($alamat)
                        <p>Alamat kamu sudah diisi!</p>
                        <div class="status-section">
                            <p>Status Saat Ini :
                            @if ($alamat->status === 'verifikasi')
                                <span class="badge bg-success">Terverifikasi</span>
                            @elseif ($alamat->status === 'perbaikan')
                                <span class="badge bg-warning">Perlu Perbaikan</span>
                            @else
                                <span class="badge bg-secondary">Belum Terverifikasi</span>
                            @endif
                            </p>
                        </div>
                        <a href="{{ route('alamat.index') }}" class="btn btn-primary mt-2">Lihat Alamat</a>
                    @else
                        <p>Alamat belum diisi.</p>
                        <div class="status-section">
                            <span class="badge bg-warning">Perlu Perbaikan</span>
                        </div>
                        <a href="{{ route('alamat.create') }}" class="btn btn-warning mt-2">Lengkapi Sekarang</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Card Data Orang Tua -->
        <div class="col-lg-4 col-md-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Data Orang Tua</h5>
                    @php
                        $dataOrangTua = auth()->user()->calonSiswa->dataOrangTua;
                    @endphp
                    @if ($dataOrangTua)
                        <p>Data orang tua kamu sudah diisi!</p>
                        <div class="status-section">
                            <p>Status Saat Ini :
                            @if ($dataOrangTua->status === 'verifikasi')
                                <span class="badge bg-success">Terverifikasi</span>
                            @elseif ($dataOrangTua->status === 'perbaikan')
                                <span class="badge bg-warning">Perlu Perbaikan</span>
                            @else
                                <span class="badge bg-secondary">Belum Terverifikasi</span>
                            @endif
                            </p>
                        </div>
                        <a href="{{ route('data-orang-tua.index') }}" class="btn btn-primary mt-2">Lihat Data Orang Tua</a>
                    @else
                        <p>Data orang tua belum diisi.</p>
                        <div class="status-section">
                            <span class="badge bg-warning">Perlu Perbaikan</span>
                        </div>
                        <a href="{{ route('data-orang-tua.create') }}" class="btn btn-warning mt-2">Lengkapi Sekarang</a>
                    @endif
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
