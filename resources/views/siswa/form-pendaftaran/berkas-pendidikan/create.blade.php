@extends('siswa.layouts.siswa-layout')

@section('title', 'Unggah Berkas Pendidikan Calon Siswa')

@section('content')
<div class="pagetitle">
    <h1>Unggah Berkas Pendidikan Calon Siswa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('berkas-pendidikan.index') }}">Berkas Pendidikan</a></li>
            <li class="breadcrumb-item active">Unggah Berkas</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Unggah Berkas Pendidikan Anda</h5>

            <form action="{{ route('berkas-pendidikan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="ijazah" class="form-label">Ijazah</label>
                    <input type="file" class="form-control @error('ijazah') is-invalid @enderror" id="ijazah" name="ijazah" required>
                    @error('ijazah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="skhun" class="form-label">SKHUN</label>
                    <input type="file" class="form-control @error('skhun') is-invalid @enderror" id="skhun" name="skhun" required>
                    @error('skhun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="raport" class="form-label">Raport</label>
                    <input type="file" class="form-control @error('raport') is-invalid @enderror" id="raport" name="raport" required>
                    @error('raport')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kartu_keluarga" class="form-label">Kartu Keluarga</label>
                    <input type="file" class="form-control @error('kartu_keluarga') is-invalid @enderror" id="kartu_keluarga" name="kartu_keluarga" required>
                    @error('kartu_keluarga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Unggah</button>
            </form>
        </div>
    </div>
</section>
@endsection
