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
        @foreach($calonSiswa as $index => $siswa)
        <div class="col-lg-4 col-md-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Data Diri Calon Siswa #{{ $index + 1 }}</h5>
                    <p><strong>Nama Lengkap:</strong> {{ $siswa->nama_lengkap }}</p>
                    <p><strong>Tempat Lahir:</strong> {{ $siswa->tempat_lahir }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ ucfirst($siswa->jenis_kelamin) }}</p>
                    <p><strong>Agama:</strong> {{ ucfirst($siswa->agama) }}</p>
                    <p><strong>NISN:</strong> {{ ucfirst($siswa->nisn) }}</p>
                    <p><strong>Nomor KK:</strong> {{ ucfirst($siswa->no_kk) }}</p>
                    <p><strong>NIK:</strong> {{ ucfirst($siswa->nik) }}</p>
                    <p><strong>Nomor HP:</strong> {{ $siswa->no_hp }}</p>
                    <p><strong>Status:</strong>
                        @if ($siswa->status === 'belum diverifikasi')
                            <span class="badge bg-info text-dark"><i class="bi bi-info-circle me-1"></i> Belum Diverifikasi</span>
                        @elseif ($siswa->status === 'perlu perbaikan')
                            <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Perlu Perbaikan</span>
                        @elseif ($siswa->status === 'terverifikasi')
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Terverifikasi</span>
                        @endif
                    </p>
                    
                    @if($siswa->status === 'perlu perbaikan')
                        <a href="{{ route('calon-siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($calonSiswa->isEmpty())
    <div class="alert alert-warning" role="alert">
        Belum ada data calon siswa. <a href="{{ route('calon-siswa.create') }}" class="btn btn-primary btn-sm">Lengkapi Data Diri</a>
    </div>
    @endif
</section>
@endsection