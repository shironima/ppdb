@extends('siswa.layouts.siswa-layout')

@section('title', 'Edit Data Diri Calon Siswa')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Edit Data Diri Calon Siswa</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('siswa.update.data-diri', $calonSiswa->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Metode PUT untuk update data -->

                <!-- Nama Lengkap -->
                <div class="form-group mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control"
                        value="{{ old('nama_lengkap', $calonSiswa->nama_lengkap) }}" placeholder="Masukkan nama lengkap" required>
                </div>

                <!-- Tempat Lahir -->
                <div class="form-group mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control"
                        value="{{ old('tempat_lahir', $calonSiswa->tempat_lahir) }}" placeholder="Masukkan tempat lahir" required>
                </div>

                <!-- Tanggal Lahir -->
                <div class="form-group mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                        value="{{ old('tanggal_lahir', $calonSiswa->tanggal_lahir) }}" required>
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-group mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                        <option value="laki-laki" {{ (old('jenis_kelamin', $calonSiswa->jenis_kelamin) == 'laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ (old('jenis_kelamin', $calonSiswa->jenis_kelamin) == 'perempuan') ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Agama -->
                <div class="form-group mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select id="agama" name="agama" class="form-control" required>
                        <option value="katholik" {{ (old('agama', $calonSiswa->agama) == 'katholik') ? 'selected' : '' }}>Katholik</option>
                        <option value="kristen" {{ (old('agama', $calonSiswa->agama) == 'kristen') ? 'selected' : '' }}>Kristen</option>
                        <option value="islam" {{ (old('agama', $calonSiswa->agama) == 'islam') ? 'selected' : '' }}>Islam</option>
                        <option value="hindu" {{ (old('agama', $calonSiswa->agama) == 'hindu') ? 'selected' : '' }}>Hindu</option>
                        <option value="budha" {{ (old('agama', $calonSiswa->agama) == 'budha') ? 'selected' : '' }}>Budha</option>
                        <option value="lainnya" {{ (old('agama', $calonSiswa->agama) == 'lainnya') ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <!-- NISN -->
                <div class="form-group mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" id="nisn" name="nisn" class="form-control" 
                        value="{{ old('nisn', $calonSiswa->nisn) }}" placeholder="Masukkan NISN" required>
                </div>

                <!-- No. KK -->
                <div class="form-group mb-3">
                    <label for="no_kk" class="form-label">No. KK / Kartu Keluarga</label>
                    <input type="text" id="no_kk" name="no_kk" class="form-control"
                        value="{{ old('no_kk', $calonSiswa->no_kk) }}" placeholder="Masukkan Nomor KK" required>
                </div>

                <!-- NIK Siswa -->
                <div class="form-group mb-3">
                    <label for="nik_siswa" class="form-label">NIK Siswa</label>
                    <input type="text" id="nik_siswa" name="nik_siswa" class="form-control"
                        value="{{ old('nik_siswa', $calonSiswa->nik_siswa) }}" placeholder="Masukkan NIK Siswa" required>
                </div>

                <!-- Nomor HP -->
                <div class="form-group mb-3">
                    <label for="nomor_hp" class="form-label">Nomor HP / Telepon</label>
                    <input type="text" id="nomor_hp" name="nomor_hp" class="form-control"
                        value="{{ old('nomor_hp', $calonSiswa->nomor_hp) }}" placeholder="Masukkan Nomor HP/Telepon" required>
                </div>

                <!-- Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
