@extends('siswa.layouts.siswa-layout')

@section('title', 'Edit Data Diri Calon Siswa')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Edit Data Diri Calon Siswa</h3>
        </div>
        <div class="card-body">
            <!-- Notifikasi SweetAlert -->
            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 2000
                    });
                </script>
            @elseif($errors->any())
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terdapat beberapa kesalahan pada pengisian form.',
                    });
                </script>
            @endif

            <form action="{{ route('calon-siswa.update', $calonSiswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Lengkap -->
                <div class="form-group mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('nama_lengkap', $calonSiswa->nama_lengkap) }}" required>
                    @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tempat Lahir dan Tanggal Lahir -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir', $calonSiswa->tempat_lahir) }}" required>
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $calonSiswa->tanggal_lahir) }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-group mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="" disabled>Pilih Jenis Kelamin</option>
                        <option value="laki-laki" {{ old('jenis_kelamin', $calonSiswa->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ old('jenis_kelamin', $calonSiswa->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Agama -->
                <div class="form-group mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select id="agama" name="agama" class="form-control @error('agama') is-invalid @enderror" required>
                        <option value="" disabled>Pilih Agama</option>
                        <option value="katholik" {{ old('agama', $calonSiswa->agama) == 'katholik' ? 'selected' : '' }}>Katholik</option>
                        <option value="kristen" {{ old('agama', $calonSiswa->agama) == 'kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="islam" {{ old('agama', $calonSiswa->agama) == 'islam' ? 'selected' : '' }}>Islam</option>
                        <option value="hindu" {{ old('agama', $calonSiswa->agama) == 'hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="budha" {{ old('agama', $calonSiswa->agama) == 'budha' ? 'selected' : '' }}>Budha</option>
                        <option value="lainnya" {{ old('agama', $calonSiswa->agama) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('agama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NISN, NIK, No. KK -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" id="nisn" name="nisn" class="form-control @error('nisn') is-invalid @enderror" placeholder="Masukkan NISN" value="{{ old('nisn', $calonSiswa->nisn) }}" required maxlength="10">
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="Masukkan NIK" value="{{ old('nik', $calonSiswa->nik) }}" required maxlength="16">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="no_kk" class="form-label">No. KK</label>
                            <input type="text" id="no_kk" name="no_kk" class="form-control @error('no_kk') is-invalid @enderror" placeholder="Masukkan Nomor KK" value="{{ old('no_kk', $calonSiswa->no_kk) }}" required maxlength="16">
                            @error('no_kk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Nomor HP -->
                <div class="form-group mb-3">
                    <label for="no_hp" class="form-label">Nomor HP / Telepon</label>
                    <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Masukkan Nomor HP/Telepon" value="{{ old('no_hp', $calonSiswa->no_hp) }}" required pattern="\d+" maxlength="15" title="Hanya boleh memasukkan angka">
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
