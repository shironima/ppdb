@extends('siswa.layouts.siswa-layout')

@section('title', 'Edit Berkas Pendidikan Calon Siswa')

@section('content')
<div class="pagetitle">
    <h1>Edit Berkas Pendidikan Calon Siswa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('berkas-pendidikan.index') }}">Berkas Pendidikan</a></li>
            <li class="breadcrumb-item active">Edit Berkas</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Berkas Pendidikan Anda</h5>

            <form action="{{ route('berkas-pendidikan.update', $berkasPendidikan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="ijazah" class="form-label">Ijazah</label>
                    <input type="file" class="form-control @error('ijazah') is-invalid @enderror" id="ijazah" name="ijazah">
                    @if($berkasPendidikan->ijazah)
                        <div class="mt-2">
                            <a href="{{ asset($berkasPendidikan->ijazah) }}" target="_blank">Lihat Ijazah</a>
                        </div>
                    @endif
                    @error('ijazah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="skhun" class="form-label">SKHUN</label>
                    <input type="file" class="form-control @error('skhun') is-invalid @enderror" id="skhun" name="skhun">
                    @if($berkasPendidikan->skhun)
                        <div class="mt-2">
                            <a href="{{ asset($berkasPendidikan->skhun) }}" target="_blank">Lihat SKHUN</a>
                        </div>
                    @endif
                    @error('skhun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="raport" class="form-label">Raport</label>
                    <input type="file" class="form-control @error('raport') is-invalid @enderror" id="raport" name="raport">
                    @if($berkasPendidikan->raport)
                        <div class="mt-2">
                            <a href="{{ asset($berkasPendidikan->raport) }}" target="_blank">Lihat Raport</a>
                        </div>
                    @endif
                    @error('raport')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kartu_keluarga" class="form-label">Kartu Keluarga</label>
                    <input type="file" class="form-control @error('kartu_keluarga') is-invalid @enderror" id="kartu_keluarga" name="kartu_keluarga">
                    @if($berkasPendidikan->kartu_keluarga)
                        <div class="mt-2">
                            <a href="{{ asset($berkasPendidikan->kartu_keluarga) }}" target="_blank">Lihat Kartu Keluarga</a>
                        </div>
                    @endif
                    @error('kartu_keluarga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Berkas</button>
            </form>
        </div>
    </div>
</section>
@endsection
