@extends('siswa.layouts.siswa-layout')

@section('title', 'Data Orang Tua')

@section('content')
<div class="pagetitle">
    <h1>Data Orang Tua</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Orang Tua</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        @foreach($dataOrangTua as $index => $orangTua)
        <div class="col-lg-4 col-md-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Data Orang Tua #{{ $index + 1 }}</h5>
                    <p><strong>Nama Ayah:</strong> {{ $orangTua->nama_ayah }}</p>
                    <p><strong>NIK Ayah:</strong> {{ $orangTua->nik_ayah }}</p>
                    <p><strong>Tahun Lahir Ayah:</strong> {{ $orangTua->tahun_lahir_ayah }}</p>
                    <p><strong>Pendidikan Ayah:</strong> {{ $orangTua->pendidikan_ayah }}</p>
                    <p><strong>Pekerjaan Ayah:</strong> {{ $orangTua->pekerjaan_ayah }}</p>
                    <p><strong>Penghasilan Ayah:</strong> {{ $orangTua->penghasilan_ayah }}</p>
                    <p><strong>Nomor HP Ayah:</strong> {{ $orangTua->nomor_hp_ayah }}</p>
                    <hr>
                    <p><strong>Nama Ibu:</strong> {{ $orangTua->nama_ibu }}</p>
                    <p><strong>NIK Ibu:</strong> {{ $orangTua->nik_ibu }}</p>
                    <p><strong>Tahun Lahir Ibu:</strong> {{ $orangTua->tahun_lahir_ibu }}</p>
                    <p><strong>Pendidikan Ibu:</strong> {{ $orangTua->pendidikan_ibu }}</p>
                    <p><strong>Pekerjaan Ibu:</strong> {{ $orangTua->pekerjaan_ibu }}</p>
                    <p><strong>Penghasilan Ibu:</strong> {{ $orangTua->penghasilan_ibu }}</p>
                    <p><strong>Nomor HP Ibu:</strong> {{ $orangTua->nomor_hp_ibu }}</p>
                    <p><strong>Status:</strong>
                        @if ($orangTua->status === 'Belum Diverifikasi')
                            <span class="badge bg-info text-dark"><i class="bi bi-info-circle me-1"></i> Belum Diverifikasi</span>
                        @elseif ($orangTua->status === 'Perlu Perbaikan')
                            <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Perlu Perbaikan</span>
                        @elseif ($orangTua->status === 'Terverifikasi')
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Terverifikasi</span>
                        @endif
                    </p>

                    @if($orangTua->status === 'Perlu Perbaikan')
                        <a href="{{ route('data-orang-tua.edit', $orangTua->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($dataOrangTua->isEmpty())
    <div class="alert alert-warning" role="alert">
        Belum ada data orang tua. <a href="{{ route('data-orang-tua.create') }}" class="btn btn-primary btn-sm">Lengkapi Data Orang Tua</a>
    </div>
    @endif
</section>
@endsection
