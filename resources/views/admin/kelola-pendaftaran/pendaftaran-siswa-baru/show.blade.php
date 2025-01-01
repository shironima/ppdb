@extends('admin.layouts.admin-layout')

@section('title', 'Detail Pendaftar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <!-- Informasi Detail Pendaftar -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="m-0 font-weight-bold text-primary">Informasi Pendaftar</h5>
                </div>
                <div class="card-body">
                    @php
                        $statusOptions = [
                            'Verified' => 'Verified',
                            'In Progress' => 'In Progress',
                            'Requires Revision' => 'Requires Revision',
                            'Submitted' => 'Submitted',
                            'Belum Diisi' => 'Belum Diisi'
                        ];
                    @endphp

                    <!-- Tab Navigasi -->
                    <ul class="nav nav-pills mb-3" id="infoPendaftarTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="calonSiswaTab" data-bs-toggle="pill" href="#calonSiswa" role="tab">Calon Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="alamatTab" data-bs-toggle="pill" href="#alamat" role="tab">Alamat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dataOrangTuaTab" data-bs-toggle="pill" href="#dataOrangTua" role="tab">Data Orang Tua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dataRinciTab" data-bs-toggle="pill" href="#dataRinci" role="tab">Data Rinci</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="infoPendaftarTabContent">
                        <!-- Calon Siswa -->
                        <div class="tab-pane fade show active" id="calonSiswa" role="tabpanel">
                            <h6>Calon Siswa</h6>
                            <table class="table table-bordered">
                                <tr><th>Nama Lengkap</th><td>{{ $pendaftar->calonSiswa->nama_lengkap ?? '-' }}</td></tr>
                                <tr><th>Tempat, Tanggal Lahir</th><td>{{ $pendaftar->calonSiswa->tempat_lahir ?? '-' }}, {{ $pendaftar->calonSiswa->tanggal_lahir ?? '-' }}</td></tr>
                                <tr><th>Jenis Kelamin</th><td>{{ $pendaftar->calonSiswa->jenis_kelamin ?? '-' }}</td></tr>
                                <tr><th>NISN</th><td>{{ $pendaftar->calonSiswa->nisn ?? '-' }}</td></tr>
                                <tr><th>Agama</th><td>{{ $pendaftar->calonSiswa->agama ?? '-' }}</td></tr>
                                <tr><th>Nomor Kartu Keluarga</th><td>{{ $pendaftar->calonSiswa->no_kk ?? '-' }}</td></tr>
                                <tr><th>NIK</th><td>{{ $pendaftar->calonSiswa->nik ?? '-' }}</td></tr>
                                <tr><th>Nomor Handphone</th><td>{{ $pendaftar->calonSiswa->no_hp ?? '-' }}</td></tr>
                            </table>

                            <!-- Pembaruan Status -->
                            <h6 class="mt-3">Status</h6>
                            <div class="d-flex justify-content-between">
                                <div>
                                    @include('admin.components.update-status', [
                                        'action' => route('admin.verifikasi-pendaftaran.updateStatus', ['type' => 'calon_siswa', 'id' => $pendaftar->id]),
                                        'statusOptions' => $statusOptions,
                                        'currentStatus' => $pendaftar->calonSiswa->status ?? null
                                    ])
                                </div>
                            </div>

                            <!-- Komentar Calon Siswa -->
                            <h6 class="mt-3">Komentar Calon Siswa</h6>
                            <form action="{{ route('admin.verifikasi-pendaftaran.updateComment', ['type' => 'calon_siswa', 'id' => $pendaftar->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="komentar_calon_siswa" class="form-label">Komentar</label>
                                    <textarea class="form-control" id="komentar_calon_siswa" name="komentar" rows="4" placeholder="Masukkan komentar Anda di sini...">{{ old('komentar', $pendaftar->calonSiswa->komentar) }}</textarea>
                                    @error('komentar')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Komentar</button>
                            </form>

                            <hr class="my-4">

                            <!-- Menampilkan Komentar Calon Siswa -->
                            <div class="border p-3 rounded" style="background-color: #f9f9f9;">
                                @if($pendaftar->calonSiswa->komentar)
                                    <p class="mb-0">{{ $pendaftar->calonSiswa->komentar }}</p>
                                @else
                                    <p class="text-muted mb-0">Belum ada komentar.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="tab-pane fade" id="alamat" role="tabpanel">
                            <h6>Alamat</h6>
                            <table class="table table-bordered">
                                <tr><th>Alamat Lengkap</th><td>{{ $pendaftar->alamat->alamat_lengkap ?? '-' }}</td></tr>
                                <tr><th>RT/RW</th><td>{{ $pendaftar->alamat->rt ?? '-' }}/{{ $pendaftar->alamat->rw ?? '-' }}</td></tr>
                                <tr><th>Kelurahan</th><td>{{ $pendaftar->alamat->kelurahan ?? '-' }}</td></tr>
                                <tr><th>Kecamatan</th><td>{{ $pendaftar->alamat->kecamatan ?? '-' }}</td></tr>
                                <tr><th>Kota/Kabupaten</th><td>{{ $pendaftar->alamat->kota_kabupaten ?? '-' }}</td></tr>
                                <tr><th>Provinsi</th><td>{{ $pendaftar->alamat->provinsi ?? '-' }}</td></tr>
                                <tr><th>Kode Pos</th><td>{{ $pendaftar->alamat->kode_pos ?? '-' }}</td></tr>
                                <tr><th>Tinggal Dengan</th><td>{{ $pendaftar->alamat->tinggal_dengan ?? '-' }}</td></tr>
                            </table>

                            <!-- Pembaruan Status -->
                            <h6 class="mt-3">Status</h6>
                            <div class="d-flex justify-content-between">
                                <div>
                                    @include('admin.components.update-status', [
                                        'action' => route('admin.verifikasi-pendaftaran.updateStatus', ['type' => 'alamat', 'id' => $pendaftar->id]),
                                        'statusOptions' => $statusOptions,
                                        'currentStatus' => $pendaftar->alamat->status ?? null
                                    ])
                                </div>
                            </div>

                            <!-- Komentar Alamat -->
                            <h6 class="mt-3">Komentar Alamat</h6>
                            <form action="{{ route('admin.verifikasi-pendaftaran.updateComment', ['type' => 'alamat', 'id' => $pendaftar->id]) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="komentar_alamat" class="form-label">Komentar</label>
                                    <textarea class="form-control" id="komentar_alamat" name="komentar" rows="4" placeholder="Masukkan komentar Anda di sini...">{{ old('komentar', $pendaftar->alamat->komentar) }}</textarea>
                                    @error('komentar')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Komentar</button>
                            </form>

                            <hr class="my-4">

                            <!-- Menampilkan Komentar Alamat -->
                            <div class="border p-3 rounded" style="background-color: #f9f9f9;">
                                @if($pendaftar->alamat->komentar)
                                    <p class="mb-0">{{ $pendaftar->alamat->komentar }}</p>
                                @else
                                    <p class="text-muted mb-0">Belum ada komentar.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Data Orang Tua -->
                        <div class="tab-pane fade" id="dataOrangTua" role="tabpanel">
                            <h6>Data Orang Tua</h6>
                            <table class="table table-bordered">
                                <tr><th>Nama Ayah</th><td>{{ $pendaftar->dataOrangTua->nama_ayah ?? '-' }}</td></tr>
                                <tr><th>NIK Ayah</th><td>{{ $pendaftar->dataOrangTua->nik_ayah ?? '-' }}</td></tr>
                                <tr><th>Tahun Lahir Ayah</th><td>{{ $pendaftar->dataOrangTua->tahun_lahir_ayah ?? '-' }}</td></tr>
                                <tr><th>Pendidikan Ayah</th><td>{{ $pendaftar->dataOrangTua->pendidikan_ayah ?? '-' }}</td></tr>
                                <tr><th>Pekerjaan Ayah</th><td>{{ $pendaftar->dataOrangTua->pekerjaan_ayah ?? '-' }}</td></tr>
                                <tr><th>Penghasilan Ayah</th><td>{{ $pendaftar->dataOrangTua->penghasilan_ayah ?? '-' }}</td></tr>
                                <tr><th>Nomor Handphone Ayah</th><td>{{ $pendaftar->dataOrangTua->nomor_hp_ayah ?? '-' }}</td></tr>
                                <tr><th>Nama Ibu</th><td>{{ $pendaftar->dataOrangTua->nama_ibu ?? '-' }}</td></tr>
                                <tr><th>NIK Ibu</th><td>{{ $pendaftar->dataOrangTua->nik_ibu ?? '-' }}</td></tr>
                                <tr><th>Tahun Lahir Ibu</th><td>{{ $pendaftar->dataOrangTua->tahun_lahir_ibu ?? '-' }}</td></tr>
                                <tr><th>Pendidikan Ibu</th><td>{{ $pendaftar->dataOrangTua->pendidikan_ibu ?? '-' }}</td></tr>
                                <tr><th>Pekerjaan Ibu</th><td>{{ $pendaftar->dataOrangTua->pekerjaan_ibu ?? '-' }}</td></tr>
                                <tr><th>Penghasilan Ibu</th><td>{{ $pendaftar->dataOrangTua->penghasilan_ibu ?? '-' }}</td></tr>
                                <tr><th>Nomor Handphone Ibu</th><td>{{ $pendaftar->dataOrangTua->nomor_hp_ibu ?? '-' }}</td></tr>
                            </table>

                            <!-- Pembaruan Status -->
                            <h6 class="mt-3">Status</h6>
                            <div class="d-flex justify-content-between">
                                <div>
                                    @include('admin.components.update-status', [
                                        'action' => route('admin.verifikasi-pendaftaran.updateStatus', ['type' => 'data_orang_tua', 'id' => $pendaftar->id]),
                                        'statusOptions' => $statusOptions,
                                        'currentStatus' => $pendaftar->dataOrangTua->status ?? null
                                    ])
                                </div>
                            </div>

                            <!-- Komentar Data Orang Tua -->
                            <h6 class="mt-3">Komentar Data Orang Tua</h6>
                            <form action="{{ route('admin.verifikasi-pendaftaran.updateComment', ['type' => 'data_orang_tua', 'id' => $pendaftar->id]) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="komentar_data_orang_tua" class="form-label">Komentar</label>
                                    <textarea class="form-control" id="komentar_data_orang_tua" name="komentar" rows="4" placeholder="Masukkan komentar Anda di sini...">{{ old('komentar', $pendaftar->dataOrangTua->komentar) }}</textarea>
                                    @error('komentar')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Komentar</button>
                            </form>

                            <hr class="my-4">

                            <!-- Menampilkan Komentar Data Orang Tua -->
                            <div class="border p-3 rounded" style="background-color: #f9f9f9;">
                                @if($pendaftar->dataOrangTua->komentar)
                                    <p class="mb-0">{{ $pendaftar->dataOrangTua->komentar }}</p>
                                @else
                                    <p class="text-muted mb-0">Belum ada komentar.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Data Rinci -->
                        <div class="tab-pane fade" id="dataRinci" role="tabpanel">
                            <h6>Data Rinci</h6>
                            <table class="table table-bordered">
                                <tr><th>Tinggi Badan</th><td>{{ $pendaftar->dataRinci->tinggi_badan ?? '-' }}</td></tr>
                                <tr><th>Berat Badan</th><td>{{ $pendaftar->dataRinci->berat_badan ?? '-' }}</td></tr>
                                <tr><th>Anak ke</th><td>{{ $pendaftar->dataRinci->anak_ke ?? '-' }}</td></tr>
                                <tr><th>Jumlah Saudara</th><td>{{ $pendaftar->dataRinci->jumlah_saudara ?? '-' }}</td></tr>
                                <tr><th>Nama Sekolah Asal</th><td>{{ $pendaftar->dataRinci->nama_sekolah ?? '-' }}</td></tr>
                                <tr><th>Alamat Sekolah Asal</th><td>{{ $pendaftar->dataRinci->alamat_sekolah_asal ?? '-' }}</td></tr>
                                <tr><th>Tahun Lulus</th><td>{{ $pendaftar->dataRinci->tahun_lulus ?? '-' }}</td></tr>
                            </table>

                            <!-- Pembaruan Status -->
                            <h6 class="mt-3">Status</h6>
                            <div class="d-flex justify-content-between">
                                <div>
                                    @include('admin.components.update-status', [
                                        'action' => route('admin.verifikasi-pendaftaran.updateStatus', ['type' => 'data_rinci', 'id' => $pendaftar->id]),
                                        'statusOptions' => $statusOptions,
                                        'currentStatus' => $pendaftar->dataRinci->status ?? null
                                    ])
                                </div>
                            </div>

                            <!-- Komentar Data Rinci -->
                            <h6 class="mt-3">Komentar Data Rinci</h6>
                            <form action="{{ route('admin.verifikasi-pendaftaran.updateComment', ['type' => 'data_rinci', 'id' => $pendaftar->id]) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="komentar_data_rinci" class="form-label">Komentar</label>
                                    <textarea class="form-control" id="komentar_data_rinci" name="komentar" rows="4" placeholder="Masukkan komentar Anda di sini...">{{ old('komentar', $pendaftar->dataRinci->komentar) }}</textarea>
                                    @error('komentar')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Komentar</button>
                            </form>

                            <hr class="my-4">
                    
                            <!-- Menampilkan Komentar Data Rinci -->
                            <div class="border p-3 rounded" style="background-color: #f9f9f9;">
                                @if($pendaftar->dataRinci->komentar)
                                    <p class="mb-0">{{ $pendaftar->dataRinci->komentar }}</p>
                                @else
                                    <p class="text-muted mb-0">Belum ada komentar.</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if(session('success'))
    <script>
        const activeTab = localStorage.getItem('activeTab') || 'calonSiswaTab';
        localStorage.setItem('activeTab', activeTab);

        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Tutup'
        }).then((result) => {
            document.getElementById(activeTab)?.classList.add('active');
            const activeTabContent = document.querySelector(`.tab-pane#${activeTab.split('Tab')[0]}`);
            if (activeTabContent) {
                activeTabContent.classList.add('show', 'active');
            }
        });
    </script>
@endif
@endpush
