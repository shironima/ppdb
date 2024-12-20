@extends('siswa.layouts.siswa-layout')

@section('title', 'Data Rinci Calon Siswa')

@section('content')
<div class="pagetitle">
    <h1>Data Rinci Calon Siswa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Rinci</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        @foreach($dataRinci as $index => $data)
        <div class="col-lg-4 col-md-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Data Rinci Calon Siswa #{{ $index + 1 }}</h5>
                    <p><strong>Tinggi Badan:</strong> {{ $data->tinggi_badan }} cm</p>
                    <p><strong>Berat Badan:</strong> {{ $data->berat_badan }} kg</p>
                    <p><strong>Anak Ke:</strong> {{ $data->anak_ke }}</p>
                    <p><strong>Jumlah Saudara:</strong> {{ $data->jumlah_saudara }}</p>
                    <p><strong>Asal Sekolah:</strong> {{ $data->asal_sekolah }}</p>
                    <p><strong>Tahun Lulus:</strong> {{ $data->tahun_lulus }}</p>
                    <p><strong>Alamat Sekolah:</strong> {{ $data->alamat_sekolah_asal }}</p>
                    <p><strong>Status:</strong>
                        @if ($data->status === 'Submitted')
                            <span class="badge bg-primary text-light"><i class="bi bi-check-circle me-1"></i>Submitted</span>
                        @elseif ($data->status === 'In Progress')
                            <span class="badge bg-secondary text-light"><i class="bi bi-info-circle me-1"></i>In Progress</span>
                        @elseif ($data->status === 'Requires Revision')
                            <span class="badge bg-warning text-dark"><i class="bi bi-info-triangle me-1"></i>Requires Revision</span>
                        @elseif ($data->status === 'Verified')
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Verified</span>
                        @endif
                    </p>

                    @if($data->status === 'Requires Revision')
                        <a href="{{ route('data-rinci.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($dataRinci->isEmpty())
    <div class="alert alert-warning" role="alert">
        Belum ada data rinci calon siswa. <a href="{{ route('data-rinci.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
    </div>
    @endif
</section>
@endsection
