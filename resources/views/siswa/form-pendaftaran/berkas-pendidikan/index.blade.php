@extends('siswa.layouts.siswa-layout')

@section('title', 'Berkas Pendidikan Calon Siswa')

@section('content')
<div class="pagetitle">
    <h1>Berkas Pendidikan Calon Siswa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Berkas Pendidikan</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        @forelse($berkasPendidikan as $berkas)
        <div class="col-lg-12 d-flex mb-4">
            <!-- Card Utama (Berkas Pendidikan) -->
            <div class="card info-card flex-grow-1 me-3">
                <div class="card-body">
                    <h5 class="card-title">Berkas Pendidikan</h5>
                    <p><strong>Ijazah:</strong> 
                        @if ($berkas->ijazah)
                            <a href="{{ $berkas->getFileUrl('ijazah') }}" target="_blank">Lihat Ijazah</a>
                        @else
                            <span class="text-muted">Belum diunggah</span>
                        @endif
                    </p>
                    <p><strong>SKHUN:</strong> 
                        @if ($berkas->skhun)
                            <a href="{{ $berkas->getFileUrl('skhun') }}" target="_blank">Lihat SKHUN</a>
                        @else
                            <span class="text-muted">Belum diunggah</span>
                        @endif
                    </p>
                    <p><strong>Raport:</strong> 
                        @if ($berkas->raport)
                            <a href="{{ $berkas->getFileUrl('raport') }}" target="_blank">Lihat Raport</a>
                        @else
                            <span class="text-muted">Belum diunggah</span>
                        @endif
                    </p>
                    <p><strong>Kartu Keluarga:</strong> 
                        @if ($berkas->kartu_keluarga)
                            <a href="{{ $berkas->getFileUrl('kartu_keluarga') }}" target="_blank">Lihat Kartu Keluarga</a>
                        @else
                            <span class="text-muted">Belum diunggah</span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Kolom Sebelah (Status dan Komentar) -->
            <div class="flex-column w-50">
                <!-- Card Status -->
                <div class="card status-card mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Status</h5>
                        <p>
                            @switch($berkas->status)
                                @case('Submitted')
                                    <span class="badge bg-primary text-light"><i class="bi bi-check-circle me-1"></i> Submitted</span>
                                    @break
                                @case('In Progress')
                                    <span class="badge bg-secondary text-light"><i class="bi bi-info-circle me-1"></i> In Progress</span>
                                    @break
                                @case('Requires Revision')
                                    <span class="badge bg-warning text-dark"><i class="bi bi-info-triangle me-1"></i> Requires Revision</span>
                                    @break
                                @case('Verified')
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Verified</span>
                                    @break
                                @case('Updated')
                                    <span class="badge bg-info text-dark"><i class="bi bi-pencil me-1"></i> Updated</span>
                                    @break
                                @default
                                    <span class="badge bg-light text-dark"><i class="bi bi-question-circle me-1"></i> Unknown</span>
                            @endswitch
                        </p>

                        @if($berkas->status === 'Requires Revision')
                            <a href="{{ route('berkas-pendidikan.edit', $berkas->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endif
                    </div>
                </div>

                <!-- Card Komentar -->
                <div class="card comment-card">
                    <div class="card-body">
                        <h5 class="card-title">Komentar</h5>
                        <p>{{ $berkas->komentar ?? 'Belum ada komentar.' }}</p>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-warning" role="alert">
            Belum ada data berkas pendidikan. 
            <a href="{{ route('berkas-pendidikan.create') }}" class="btn btn-primary btn-sm">Tambah Berkas</a>
        </div>
        @endforelse
    </div>
</section>
@endsection
