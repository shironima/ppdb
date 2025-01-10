@extends('siswa.layouts.siswa-layout')

@section('title', 'Daftar Data Diri Calon Siswa')

@section('content')
<div class="pagetitle">
    <h1>Data Diri Calon Siswa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Diri</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        @if($calonSiswa)
        <div class="col-lg-12 d-flex mb-4">
            <!-- Card Utama (Data Diri Calon Siswa) -->
            <div class="card info-card flex-grow-1 me-3">
                <div class="card-body">
                    <h5 class="card-title">Data Diri Calon Siswa</h5>
                    <p><strong>Nama Lengkap:</strong> {{ $calonSiswa->nama_lengkap ?? 'N/A' }}</p>
                    <p><strong>Tempat Lahir:</strong> {{ $calonSiswa->tempat_lahir ?? 'N/A' }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ isset($calonSiswa->tanggal_lahir) ? \Carbon\Carbon::parse($calonSiswa->tanggal_lahir)->format('d M Y') : 'N/A' }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ $calonSiswa->jenis_kelamin ?? 'N/A' }}</p>
                    <p><strong>Agama:</strong> {{ $calonSiswa->agama ?? 'N/A' }}</p>
                    <p><strong>NISN:</strong> {{ $calonSiswa->nisn ?? 'N/A' }}</p>
                    <p><strong>Nomor KK:</strong> {{ $calonSiswa->no_kk ?? 'N/A' }}</p>
                    <p><strong>NIK:</strong> {{ $calonSiswa->nik ?? 'N/A' }}</p>
                    <p><strong>Nomor HP:</strong> {{ $calonSiswa->no_hp ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Kolom Sebelah (Status dan Komentar) -->
            <div class="flex-column w-50">
                <!-- Card Status -->
                <div class="card status-card mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Status</h5>
                        <p>
                            @if ($calonSiswa->status === 'Submitted')
                                <span class="badge bg-primary text-light"><i class="bi bi-check-circle me-1"></i>Submitted</span>
                            @elseif ($calonSiswa->status === 'In Progress')
                                <span class="badge bg-secondary text-light"><i class="bi bi-info-circle me-1"></i>In Progress</span>
                            @elseif ($calonSiswa->status === 'Requires Revision')
                                <span class="badge bg-warning text-dark"><i class="bi bi-info-triangle me-1"></i>Requires Revision</span>
                            @elseif ($calonSiswa->status === 'Updated')
                                <span class="badge bg-info text-light"><i class="bi bi-arrow-repeat me-1"></i>Updated</span>
                            @elseif ($calonSiswa->status === 'Verified')
                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Verified</span>
                            @endif
                        </p>

                        @if($calonSiswa->status === 'Requires Revision')
                            <a href="{{ route('calon-siswa.edit', $calonSiswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endif
                    </div>
                </div>

                <!-- Card Komentar -->
                <div class="card comment-card">
                    <div class="card-body">
                        <h5 class="card-title">Komentar</h5>
                        <p>{{ $calonSiswa->komentar ?? 'Belum ada komentar.' }}</p>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                Belum ada data calon siswa. <a href="{{ route('calon-siswa.create') }}" class="btn btn-primary btn-sm">Lengkapi Data Diri</a>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
