@extends('siswa.layouts.siswa-layout')

@section('title', 'Formulir Pendaftaran Data Diri Calon Siswa')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Formulir Pendaftaran Data Diri Calon Siswa</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('calon-siswa.store') }}" method="POST">
                @csrf

                <!-- Nama Lengkap -->
                <div class="form-group mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('nama_lengkap') }}" required>
                    @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tempat Lahir -->
                <div class="form-group mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}" required>
                    @error('tempat_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanggal Lahir -->
                <div class="form-group mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required>
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-group mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Agama -->
                <div class="form-group mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select id="agama" name="agama" class="form-control @error('agama') is-invalid @enderror" required>
                        <option value="katholik" {{ old('agama') == 'katholik' ? 'selected' : '' }}>Katholik</option>
                        <option value="kristen" {{ old('agama') == 'kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="islam" {{ old('agama') == 'islam' ? 'selected' : '' }}>Islam</option>
                        <option value="hindu" {{ old('agama') == 'hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="budha" {{ old('agama') == 'budha' ? 'selected' : '' }}>Budha</option>
                        <option value="lainnya" {{ old('agama') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('agama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NISN -->
                <div class="form-group mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" id="nisn" name="nisn" class="form-control @error('nisn') is-invalid @enderror" placeholder="Masukkan NISN" value="{{ old('nisn') }}" required>
                    @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- No. KK -->
                <div class="form-group mb-3">
                    <label for="no_kk" class="form-label">No. KK / Kartu Keluarga</label>
                    <input type="text" id="no_kk" name="no_kk" class="form-control @error('no_kk') is-invalid @enderror" placeholder="Masukkan Nomor KK" value="{{ old('no_kk') }}" required>
                    @error('no_kk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIK Siswa -->
                <div class="form-group mb-3">
                    <label for="nik_siswa" class="form-label">NIK Siswa</label>
                    <input type="text" id="nik_siswa" name="nik_siswa" class="form-control @error('nik_siswa') is-invalid @enderror" placeholder="Masukkan NIK Siswa" value="{{ old('nik_siswa') }}" required>
                    @error('nik_siswa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nomor HP -->
                <div class="form-group mb-3">
                    <label for="nomor_hp" class="form-label">Nomor HP / Telepon</label>
                    <input type="text" id="nomor_hp" name="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror" placeholder="Masukkan Nomor HP/Telepon" value="{{ old('nomor_hp') }}" required>
                    @error('nomor_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">Daftar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
