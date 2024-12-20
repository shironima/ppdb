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
        <!-- Card Welcome -->
        <div class="col-lg-4 col-md-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Welcome</h5>
                    <p>Hallo, <strong>{{ Auth::user()->name }}</strong>! Selamat datang di Dashboard Calon Siswa.</p>
                    <p>Catatan: <br>
                    Harap isi formulir <a href="{{ route('calon-siswa.index')}}">Data Diri</a> terlebih dahulu sebelum melanjutkan mengisi bagian formulir lainnya.</p>
                </div>
            </div>
        </div>

        <!-- Card Data Diri -->
        <div class="col-lg-4 col-md-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Data Diri</h5>
                    @php
                        $calonSiswa = Auth::user()->calonSiswa;
                        $status = $calonSiswa ? $calonSiswa->status : null;
                    @endphp
                    @if ($calonSiswa)
                        <p>Data diri kamu sudah lengkap!</p>
                        <div class="status-section">
                            <p>Status Saat Ini :
                                @switch($status)
                                    @case('Submitted')
                                        <span class="badge bg-success">Submitted</span>
                                        @break
                                    @case('In Verified')
                                        <span class="badge bg-success">Verified</span>
                                        @break
                                    @case('In Progress')
                                        <span class="badge bg-success">In Progress</span>
                                        @break
                                    @case('Requires Revision')
                                        <span class="badge bg-warning">Requires Revision</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $status }}</span>
                                @endswitch
                            </p>
                        </div>
                        <a href="{{ route('calon-siswa.index') }}" class="btn btn-primary mt-2">Lihat Data Diri</a>
                    @else
                        <p>Data diri belum diisi.</p>
                        <div class="status-section"></div>
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
                        $alamat = Auth::user()->calonSiswa->alamat ?? null;
                    @endphp
                    @if ($alamat)
                        <p>Alamat kamu sudah diisi!</p>
                        <div class="status-section">
                            <p>Status Saat Ini :
                                @switch($status)
                                    @case('Submitted')
                                        <span class="badge bg-success">Submitted</span>
                                        @break
                                    @case('In Verified')
                                        <span class="badge bg-success">Verified</span>
                                        @break
                                    @case('In Progress')
                                        <span class="badge bg-success">In Progress</span>
                                        @break
                                    @case('Requires Revision')
                                        <span class="badge bg-warning">Requires Revision</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $status }}</span>
                                @endswitch
                            </p>
                        </div>
                        <a href="{{ route('alamat.index') }}" class="btn btn-primary mt-2">Lihat Alamat</a>
                    @else
                        <p>Alamat belum diisi.</p>
                        <div class="status-section"></div>
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
                        $dataOrangTua = Auth::user()->calonSiswa->dataOrangTua ?? null;
                    @endphp
                    @if ($dataOrangTua)
                        <p>Data Orang Tua kamu sudah diisi!</p>
                        <div class="status-section">
                            <p>Status Saat Ini :
                                @switch($status)
                                    @case('Submitted')
                                        <span class="badge bg-success">Submitted</span>
                                        @break
                                    @case('In Verified')
                                        <span class="badge bg-success">Verified</span>
                                        @break
                                    @case('In Progress')
                                        <span class="badge bg-success">In Progress</span>
                                        @break
                                    @case('Requires Revision')
                                        <span class="badge bg-warning">Requires Revision</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $status }}</span>
                                @endswitch
                            </p>
                        </div>
                        <a href="{{ route('data-orang-tua.index') }}" class="btn btn-primary mt-2">Lihat Data Orang Tua</a>
                    @else
                        <p>Data Orang Tua belum diisi.</p>
                        <div class="status-section"></div>
                        <a href="{{ route('data-orang-tua.create') }}" class="btn btn-warning mt-2">Lengkapi Sekarang</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Card Data Rinci -->
        <div class="col-lg-4 col-md-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Data Rinci</h5>
                    @php
                        $dataRinci = Auth::user()->calonSiswa->dataRinci ?? null;
                    @endphp
                    @if ($dataRinci)
                        <p>Data Rinci kamu sudah diisi!</p>
                        <div class="status-section">
                            <p>Status Saat Ini :
                                @switch($status)
                                    @case('Submitted')
                                        <span class="badge bg-success">Submitted</span>
                                        @break
                                    @case('In Verified')
                                        <span class="badge bg-success">Verified</span>
                                        @break
                                    @case('In Progress')
                                        <span class="badge bg-success">In Progress</span>
                                        @break
                                    @case('Requires Revision')
                                        <span class="badge bg-warning">Requires Revision</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $status }}</span>
                                @endswitch
                            </p>
                        </div>
                        <a href="{{ route('data-rinci.index') }}" class="btn btn-primary mt-2">Lihat Data Rinci</a>
                    @else
                        <p>Data Rinci belum diisi.</p>
                        <div class="status-section"></div>
                        <a href="{{ route('data-rinci.create') }}" class="btn btn-warning mt-2">Lengkapi Sekarang</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
