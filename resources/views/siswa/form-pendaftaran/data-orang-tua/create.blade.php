@extends('siswa.layouts.siswa-layout')

@section('title', 'Formulir Pendaftaran Data Orang Tua Calon Siswa')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Formulir Pendaftaran Data Orang Tua Calon Siswa</h3>
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

            <form action="{{ route('data-orang-tua.store') }}" method="POST">
                @csrf
                
                <input type="hidden" name="calon_siswa_id" value="{{ Auth::user()->id }}"> <!-- Kirimkan ID pengguna yang sedang login -->
                
                <!-- Data Ayah -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">Data Ayah</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                    <input type="text" id="nama_ayah" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" placeholder="Masukkan Nama Ayah" value="{{ old('nama_ayah') }}" required>
                                    @error('nama_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="nik_ayah" class="form-label">NIK Ayah</label>
                                    <input type="text" id="nik_ayah" name="nik_ayah" class="form-control @error('nik_ayah') is-invalid @enderror" placeholder="Masukkan NIK Ayah" value="{{ old('nik_ayah') }}" required>
                                    @error('nik_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="tahun_lahir_ayah" class="form-label">Tahun Lahir Ayah</label>
                                    <input type="number" id="tahun_lahir_ayah" name="tahun_lahir_ayah" class="form-control @error('tahun_lahir_ayah') is-invalid @enderror" placeholder="Masukkan Tahun Lahir Ayah" value="{{ old('tahun_lahir_ayah') }}" required>
                                    @error('tahun_lahir_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="pendidikan_ayah" class="form-label">Pendidikan Terakhir Ayah</label>
                                    <select id="pendidikan_ayah" name="pendidikan_ayah" class="form-control @error('pendidikan_ayah') is-invalid @enderror" required>
                                        <option value="">Pilih Pendidikan Terakhir Ayah</option>
                                        <option value="SD" {{ old('pendidikan_ayah') == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ old('pendidikan_ayah') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                        <option value="SMA" {{ old('pendidikan_ayah') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                        <option value="Diploma" {{ old('pendidikan_ayah') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                        <option value="S-1" {{ old('pendidikan_ayah') == 'S-1' ? 'selected' : '' }}>S-1</option>
                                        <option value="S-2" {{ old('pendidikan_ayah') == 'S-2' ? 'selected' : '' }}>S-2</option>
                                        <option value="Lainnya" {{ old('pendidikan_ayah') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('pendidikan_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                    <select id="pekerjaan_ayah" name="pekerjaan_ayah" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" required>
                                        <option value="">Pilih Pekerjaan Ayah</option>
                                        <option value="ASN-TNI-POLRI" {{ old('pekerjaan_ayah') == 'ASN-TNI-POLRI' ? 'selected' : '' }}>ASN-TNI-POLRI</option>
                                        <option value="Guru-Dosen-Pengajar" {{ old('pekerjaan_ayah') == 'Guru-Dosen-Pengajar' ? 'selected' : '' }}>Guru-Dosen-Pengajar</option>
                                        <option value="Pengusaha" {{ old('pekerjaan_ayah') == 'Pengusaha' ? 'selected' : '' }}>Pengusaha</option>
                                        <option value="Pedagang" {{ old('pekerjaan_ayah') == 'Pedagang' ? 'selected' : '' }}>Pedagang</option>
                                        <option value="Wiraswasta" {{ old('pekerjaan_ayah') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                        <option value="Petani-Peternak" {{ old('pekerjaan_ayah') == 'Petani-Peternak' ? 'selected' : '' }}>Petani-Peternak</option>
                                        <option value="Lainnya" {{ old('pekerjaan_ayah') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('pekerjaan_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="penghasilan_ayah" class="form-label">Penghasilan Ayah</label>
                                    <select id="penghasilan_ayah" name="penghasilan_ayah" class="form-control @error('penghasilan_ayah') is-invalid @enderror" required>
                                        <option value="">Pilih Penghasilan Ayah</option>
                                        <option value="Dibawah 1jt" {{ old('penghasilan_ayah') == 'Dibawah 1jt' ? 'selected' : '' }}>Dibawah 1jt</option>
                                        <option value="1jt-2jt" {{ old('penghasilan_ayah') == '1jt-2jt' ? 'selected' : '' }}>1jt-2jt</option>
                                        <option value="2jt-4jt" {{ old('penghasilan_ayah') == '2jt-4jt' ? 'selected' : '' }}>2jt-4jt</option>
                                        <option value="diatas 5jt" {{ old('penghasilan_ayah') == 'diatas 5jt' ? 'selected' : '' }}>Diatas 5jt</option>
                                    </select>
                                    @error('penghasilan_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nomor_hp_ayah" class="form-label">Nomor HP Ayah</label>
                                    <input type="text" id="nomor_hp_ayah" name="nomor_hp_ayah" class="form-control @error('nomor_hp_ayah') is-invalid @enderror" placeholder="Masukkan Nomor HP Ayah" value="{{ old('nomor_hp_ayah') }}" required>
                                    @error('nomor_hp_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Ibu -->
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">Data Ibu</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                    <input type="text" id="nama_ibu" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" placeholder="Masukkan Nama Ibu" value="{{ old('nama_ibu') }}" required>
                                    @error('nama_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nik_ibu" class="form-label">NIK Ibu</label>
                                    <input type="text" id="nik_ibu" name="nik_ibu" class="form-control @error('nik_ibu') is-invalid @enderror" placeholder="Masukkan NIK Ibu" value="{{ old('nik_ibu') }}" required>
                                    @error('nik_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="tahun_lahir_ibu" class="form-label">Tahun Lahir Ibu</label>
                                    <input type="number" id="tahun_lahir_ibu" name="tahun_lahir_ibu" class="form-control @error('tahun_lahir_ibu') is-invalid @enderror" placeholder="Masukkan Tahun Lahir Ibu" value="{{ old('tahun_lahir_ibu') }}" required>
                                    @error('tahun_lahir_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="pendidikan_ibu" class="form-label">Pendidikan Terakhir Ibu</label>
                                    <select id="pendidikan_ibu" name="pendidikan_ibu" class="form-control @error('pendidikan_ibu') is-invalid @enderror" required>
                                        <option value="">Pilih Pendidikan Terakhir Ibu</option>
                                        <option value="SD" {{ old('pendidikan_ibu') == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ old('pendidikan_ibu') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                        <option value="SMA" {{ old('pendidikan_ibu') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                        <option value="Diploma" {{ old('pendidikan_ibu') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                        <option value="S-1" {{ old('pendidikan_ibu') == 'S-1' ? 'selected' : '' }}>S-1</option>
                                        <option value="S-2" {{ old('pendidikan_ibu') == 'S-2' ? 'selected' : '' }}>S-2</option>
                                        <option value="Lainnya" {{ old('pendidikan_ibu') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('pendidikan_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                    <select id="pekerjaan_ibu" name="pekerjaan_ibu" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" required>
                                        <option value="">Pilih Pekerjaan Ibu</option>
                                        <option value="ASN-TNI-POLRI" {{ old('pekerjaan_ibu') == 'ASN-TNI-POLRI' ? 'selected' : '' }}>ASN-TNI-POLRI</option>
                                        <option value="Guru-Dosen-Pengajar" {{ old('pekerjaan_ibu') == 'Guru-Dosen-Pengajar' ? 'selected' : '' }}>Guru-Dosen-Pengajar</option>
                                        <option value="Pengusaha" {{ old('pekerjaan_ibu') == 'Pengusaha' ? 'selected' : '' }}>Pengusaha</option>
                                        <option value="Pedagang" {{ old('pekerjaan_ibu') == 'Pedagang' ? 'selected' : '' }}>Pedagang</option>
                                        <option value="Wiraswasta" {{ old('pekerjaan_ibu') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                        <option value="Petani-Peternak" {{ old('pekerjaan_ibu') == 'Petani-Peternak' ? 'selected' : '' }}>Petani-Peternak</option>
                                        <option value="Lainnya" {{ old('pekerjaan_ibu') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('pekerjaan_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="penghasilan_ibu" class="form-label">Penghasilan Ibu</label>
                                    <select id="penghasilan_ibu" name="penghasilan_ibu" class="form-control @error('penghasilan_ibu') is-invalid @enderror" required>
                                        <option value="">Pilih Penghasilan Ibu</option>
                                        <option value="Dibawah 1jt" {{ old('penghasilan_ibu') == 'Dibawah 1jt' ? 'selected' : '' }}>Dibawah 1jt</option>
                                        <option value="1jt-2jt" {{ old('penghasilan_ibu') == '1jt-2jt' ? 'selected' : '' }}>1jt-2jt</option>
                                        <option value="2jt-4jt" {{ old('penghasilan_ibu') == '2jt-4jt' ? 'selected' : '' }}>2jt-4jt</option>
                                        <option value="diatas 5jt" {{ old('penghasilan_ibu') == 'diatas 5jt' ? 'selected' : '' }}>Diatas 5jt</option>
                                    </select>
                                    @error('penghasilan_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nomor_hp_ibu" class="form-label">Nomor HP Ibu</label>
                                    <input type="text" id="nomor_hp_ibu" name="nomor_hp_ibu" class="form-control @error('nomor_hp_ibu') is-invalid @enderror" placeholder="Masukkan Nomor HP Ibu" value="{{ old('nomor_hp_ibu') }}" required>
                                    @error('nomor_hp_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="form-group mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
