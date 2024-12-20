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
        @forelse($calonSiswa as $index => $siswa)
        <div class="col-lg-4 col-md-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Data Diri Calon Siswa #{{ $index + 1 }}</h5>
                    <p><strong>Nama Lengkap:</strong> {{ $siswa->nama_lengkap ?? 'N/A' }}</p>
                    <p><strong>Tempat Lahir:</strong> {{ $siswa->tempat_lahir ?? 'N/A' }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ isset($siswa->tanggal_lahir) ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') : 'N/A' }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ ucfirst($siswa->jenis_kelamin) ?? 'N/A' }}</p>
                    <p><strong>Agama:</strong> {{ ucfirst($siswa->agama) ?? 'N/A' }}</p>
                    <p><strong>NISN:</strong> {{ ucfirst($siswa->nisn) ?? 'N/A' }}</p>
                    <p><strong>Nomor KK:</strong> {{ ucfirst($siswa->no_kk) ?? 'N/A' }}</p>
                    <p><strong>NIK:</strong> {{ ucfirst($siswa->nik) ?? 'N/A' }}</p>
                    <p><strong>Nomor HP:</strong> {{ $siswa->no_hp ?? 'N/A' }}</p>
                    <p><strong>Status:</strong>
                        @if ($siswa->status === 'Submitted')
                            <span class="badge bg-primary text-light"><i class="bi bi-check-circle me-1"></i>Submitted</span>
                        @elseif ($siswa->status === 'In Progress')
                            <span class="badge bg-secondary text-light"><i class="bi bi-info-circle me-1"></i>In Progress</span>
                        @elseif ($siswa->status === 'Requires Revision')
                            <span class="badge bg-warning text-dark"><i class="bi bi-info-triangle me-1"></i>Requires Revision</span>
                        @elseif ($siswa->status === 'Verified')
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Verified</span>
                        @endif
                    </p>
                    
                    @if($siswa->status === 'Requires Revision')
                        <a href="{{ route('calon-siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                Belum ada data calon siswa. <a href="{{ route('calon-siswa.create') }}" class="btn btn-primary btn-sm">Lengkapi Data Diri</a>
            </div>
        </div>
        @endforelse
    </div>
</section>
@endsection
