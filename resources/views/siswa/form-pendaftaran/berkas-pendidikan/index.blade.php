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
        @foreach($berkasPendidikan as $index => $berkas)
        <div class="col-lg-4 col-md-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Berkas Pendidikan</h5>
                    <p><strong>Ijazah:</strong> <a href="{{ $berkas->getFileUrl('ijazah') }}" target="_blank">Lihat Ijazah</a></p>
                    <p><strong>SKHUN:</strong> <a href="{{ $berkas->getFileUrl('skhun') }}" target="_blank">Lihat SKHUN</a></p>
                    <p><strong>Raport:</strong> <a href="{{ $berkas->getFileUrl('raport') }}" target="_blank">Lihat Raport</a></p>
                    <p><strong>Kartu Keluarga:</strong> <a href="{{ $berkas->getFileUrl('kartu_keluarga') }}" target="_blank">Lihat Kartu Keluarga</a></p>
                    <p><strong>Status:</strong>
                        @if ($berkas->status === 'Submitted')
                            <span class="badge bg-primary text-light"><i class="bi bi-check-circle me-1"></i>Submitted</span>
                        @elseif ($berkas->status === 'In Progress')
                            <span class="badge bg-secondary text-light"><i class="bi bi-info-circle me-1"></i>In Progress</span>
                        @elseif ($berkas->status === 'Requires Revision')
                            <span class="badge bg-warning text-dark"><i class="bi bi-info-triangle me-1"></i>Requires Revision</span>
                        @elseif ($berkas->status === 'Verified')
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Verified</span>
                        @endif
                    </p>

                    @if($berkas->status === 'Requires Revision')
                        <a href="{{ route('berkas-pendidikan.edit', $berkas->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($berkasPendidikan->isEmpty())
    <div class="alert alert-warning" role="alert">
        Belum ada data berkas pendidikan. <a href="{{ route('berkas-pendidikan.create') }}" class="btn btn-primary btn-sm">Tambah Berkas</a>
    </div>
    @endif
</section>
@endsection
