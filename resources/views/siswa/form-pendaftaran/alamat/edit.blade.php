@extends('siswa.layouts.siswa-layout')

@section('title', 'Edit Alamat Calon Siswa')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Edit Alamat Calon Siswa</h3>
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

            <form action="{{ route('alamat.update', $alamat->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Menandakan bahwa ini adalah request PUT untuk update data -->
                
                <input type="hidden" name="calon_siswa_id" value="{{ Auth::user()->id }}"> <!-- Kirimkan ID pengguna yang sedang login -->
                
                <!-- Alamat Lengkap -->
                <div class="form-group mb-3">
                    <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                    <textarea id="alamat_lengkap" name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" placeholder="Masukkan alamat lengkap" required>{{ old('alamat_lengkap', $alamat->alamat_lengkap) }}</textarea>
                    @error('alamat_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Provinsi, Kota, Kecamatan -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" id="provinsi" name="provinsi" class="form-control @error('provinsi') is-invalid @enderror" placeholder="Masukkan Provinsi" value="{{ old('provinsi', $alamat->provinsi) }}" required>
                            @error('provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="kota" class="form-label">Kota / Kabupaten</label>
                            <input type="text" id="kota" name="kota_kabupaten" class="form-control @error('kota_kabupaten') is-invalid @enderror" placeholder="Masukkan Kota / Kabupaten" value="{{ old('kota_kabupaten', $alamat->kota_kabupaten) }}" required>
                            @error('kota_kabupaten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" id="kecamatan" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" placeholder="Masukkan Kecamatan" value="{{ old('kecamatan', $alamat->kecamatan) }}" required>
                            @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- RT, RW, Kelurahan -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="rt" class="form-label">RT</label>
                            <input type="text" id="rt" name="rt" class="form-control @error('rt') is-invalid @enderror" placeholder="Masukkan RT" value="{{ old('rt', $alamat->rt) }}" required>
                            @error('rt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="rw" class="form-label">RW</label>
                            <input type="text" id="rw" name="rw" class="form-control @error('rw') is-invalid @enderror" placeholder="Masukkan RW" value="{{ old('rw', $alamat->rw) }}" required>
                            @error('rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <input type="text" id="kelurahan" name="kelurahan" class="form-control @error('kelurahan') is-invalid @enderror" placeholder="Masukkan Kelurahan" value="{{ old('kelurahan', $alamat->kelurahan) }}" required>
                            @error('kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tinggal Dengan -->
                <div class="form-group mb-3">
                    <label for="tinggal_dengan" class="form-label">Tinggal Dengan</label>
                    <select id="tinggal_dengan" name="tinggal_dengan" class="form-control @error('tinggal_dengan') is-invalid @enderror" required>
                        <option value="" disabled {{ old('tinggal_dengan', $alamat->tinggal_dengan) ? '' : 'selected' }}>Pilih Salah Satu</option>
                        <option value="orang_tua" {{ old('tinggal_dengan', $alamat->tinggal_dengan) == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                        <option value="wali-famili" {{ old('tinggal_dengan', $alamat->tinggal_dengan) == 'wali-famili' ? 'selected' : '' }}>Wali / Keluarga</option>
                        <option value="panti-asrama" {{ old('tinggal_dengan', $alamat->tinggal_dengan) == 'panti-asrama' ? 'selected' : '' }}>Panti / Asrama</option>
                        <option value="lainnya" {{ old('tinggal_dengan', $alamat->tinggal_dengan) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('tinggal_dengan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kode Pos -->
                <div class="form-group mb-3">
                    <label for="kode_pos" class="form-label">Kode Pos</label>
                    <input type="text" id="kode_pos" name="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror" placeholder="Masukkan Kode Pos" value="{{ old('kode_pos', $alamat->kode_pos) }}" required maxlength="5">
                    @error('kode_pos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
