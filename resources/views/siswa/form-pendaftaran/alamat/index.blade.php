@extends('siswa.layouts.siswa-layout')

@section('title', 'Alamat Calon Siswa')

@section('content')
<div class="pagetitle">
    <h1>Alamat Calon Siswa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Alamat</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        @foreach($alamatCalonSiswa as $index => $alamat)
        <div class="col-lg-12 d-flex mb-4">
            <!-- Card Utama (Alamat) -->
            <div class="card info-card flex-grow-1 me-3">
                <div class="card-body">
                    <h5 class="card-title">Alamat Calon Siswa</h5>
                    <p><strong>Alamat:</strong> {{ $alamat->alamat_lengkap }}</p>
                    <p><strong>RT/RW:</strong> {{ $alamat->rt }} / {{ $alamat->rw }}</p>
                    <p><strong>Kelurahan:</strong> {{ $alamat->kelurahan }}</p>
                    <p><strong>Kecamatan:</strong> {{ $alamat->kecamatan }}</p>
                    <p><strong>Kabupaten/Kota:</strong> {{ $alamat->kota_kabupaten }}</p>
                    <p><strong>Provinsi:</strong> {{ $alamat->provinsi }}</p>
                    <p><strong>Kode Pos:</strong> {{ $alamat->kode_pos }}</p>
                    <p><strong>Tinggal Dengan:</strong> {{ ucfirst($alamat->tinggal_dengan) }}</p>
                </div>
            </div>

            <!-- Kolom Sebelah (Status dan Komentar) -->
            <div class="flex-column w-50">
                <!-- Card Status -->
                <div class="card status-card mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Status</h5>
                        <p>
                            @if ($alamat->status === 'Submitted')
                                <span class="badge bg-primary text-light"><i class="bi bi-check-circle me-1"></i>Submitted</span>
                            @elseif ($alamat->status === 'In Progress')
                                <span class="badge bg-secondary text-light"><i class="bi bi-info-circle me-1"></i>In Progress</span>
                            @elseif ($alamat->status === 'Requires Revision')
                                <span class="badge bg-warning text-dark"><i class="bi bi-info-triangle me-1"></i>Requires Revision</span>
                            @elseif ($alamat->status === 'Updated')
                                <span class="badge bg-info text-light"><i class="bi bi-arrow-repeat me-1"></i>Updated</span>
                            @elseif ($alamat->status === 'Verified')
                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Verified</span>
                            @endif
                        </p>

                        @if($alamat->status === 'Requires Revision')
                            <a href="{{ route('alamat.edit', $alamat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endif
                    </div>
                </div>

                <!-- Card Komentar -->
                <div class="card comment-card">
                    <div class="card-body">
                        <h5 class="card-title">Komentar</h5>
                        <p>{{ $alamat->komentar ?? 'Belum ada komentar.' }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($alamatCalonSiswa->isEmpty())
    <div class="alert alert-warning" role="alert">
        Belum ada data alamat calon siswa. <a href="{{ route('alamat.create') }}" class="btn btn-primary btn-sm">Tambah Alamat</a>
    </div>
    @endif
</section>
@endsection
