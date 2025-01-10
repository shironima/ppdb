@extends('siswa.layouts.siswa-layout')

@section('title', 'Status Pendaftaran')

@section('content')
<div class="pagetitle">
    <h1>Status Pendaftaran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Status Pendaftaran</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Status Pendaftaran Umum</h5>
                    <!-- Menampilkan Nomor Registrasi -->
                    <div class="row mb-6">
                        <div class="col-lg-4"><strong>Nomor Registrasi</strong></div>
                        <div class="col-lg-8">
                            @if (Auth::user()->calonSiswa->registration)
                                {{ Auth::user()->calonSiswa->registration->id }}
                            @else
                                <span class="text-muted">Belum ada nomor registrasi</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Menampilkan status pendaftaran -->
                    <div class="row mb-6">
                        <div class="col-lg-4"><strong>Status</strong></div>
                        <div class="col-lg-8">
                            @if (Auth::user()->calonSiswa->registration)
                                @if (Auth::user()->calonSiswa->registration->status === 'Submitted')
                                    <span class="badge bg-primary text-light"><i class="bi bi-check-circle me-1"></i> Submitted</span>
                                @elseif (Auth::user()->calonSiswa->registration->status === 'Updated')
                                    <span class="badge bg-info text-light"><i class="bi bi-pencil-square me-1"></i> Updated</span>
                                @elseif (Auth::user()->calonSiswa->registration->status === 'Accepted')
                                    <span class="badge bg-success text-light"><i class="bi bi-check-circle me-1"></i> Accepted</span>
                                @else
                                    <span class="badge bg-secondary text-light"><i class="bi bi-exclamation-circle me-1"></i> Unknown</span>
                                @endif
                            @else
                                <span class="badge bg-warning text-light"><i class="bi bi-exclamation-circle me-1"></i> Belum Submit Pendaftaran</span>
                            @endif
                        </div>
                    </div>

                    <!-- Menampilkan komentar admin -->
                    <div class="row mb-6">
                        <div class="col-lg-4"><strong>Komentar Admin</strong></div>
                        <div class="col-lg-8">{{ $user->registration->komentar ?? 'Tidak ada komentar' }}</div>
                    </div>

                    <!-- Informasi status pendaftaran -->
                    <div class="alert alert-info mt-4">
                        <strong>Perhatian:</strong> Status pendaftaran Anda akan diperbarui oleh admin setelah semua formulir diverifikasi.
                    </div>

                    <!-- Deskripsi status pendaftaran -->
                    <div class="mt-3">
                        <h6>Deskripsi Status:</h6>
                        <ul>
                            <li><span class="badge bg-success">Submitted</span> : Pendaftaran Anda telah terkirim dan menunggu Admin melakukan verifikasi.</li>
                            <li><span class="badge bg-success">Accepted</span> : Pendaftaran Anda telah terverifikasi dan Anda telah diterima.</li>
                            <li><span class="badge bg-info">Updated</span> : Pendaftaran Anda telah diperbarui dan menunggu Admin melakukan verifikasi ulang.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Calon Siswa dan Kontak -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi Kontak Calon Siswa</h5>
                    <div class="row mb-3">
                        <div class="col-lg-4"><strong>Nama Calon Siswa</strong></div>
                        <div class="col-lg-8">{{ $user->calonSiswa->nama_lengkap ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4"><strong>Email</strong></div>
                        <div class="col-lg-8">{{ $user->notificationContact->email ?? 'Belum ada email' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4"><strong>Nomor Telepon</strong></div>
                        <div class="col-lg-8">{{ $user->notificationContact->whatsapp ?? 'Belum ada nomor telepon' }}</div>
                    </div>
                    <div class="alert alert-info mt-4">
                        <strong>Perhatian:</strong> Pastikan Anda melengkapi informasi kontak agar kami dapat menghubungi Anda.
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('notification.index') }}" class="btn btn-warning btn-sm">Lengkapi Kontak</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card untuk Informasi Kirim Pendaftaran Saya -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kirim Pendaftaran Saya dan Kirim Perbaikan Data</h5>
                    <ul>
                        <li>Setelah Anda mengisi semua formulir dengan lengkap, Anda dapat mengirimkan pendaftaran Anda untuk diproses lebih lanjut. Tombol <span class="badge bg-success">Kirim Pendaftaran Saya</span> akan aktif ketika semua formulir telah diisi dengan benar dan informasi kontak lengkap.</li>
                        <li>Jika ada formulir yang perlu diperbaiki, setelah melakukan perbaikan Anda dapat mengirimkan perbaikan data dengan menekan tombol <span class="badge bg-info">Kirim Perbaikan Data</span></li>
                    </ul>
                    <div class="alert alert-info">
                        <strong>Perhatian:</strong> Anda hanya dapat mengirimkan pendaftaran sekali. Pastikan semua data sudah benar sebelum mengirim.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Status Pendaftaran Saya -->
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Status Pendaftaran Saya</h5>
                    <div class="table-responsive">
                        <table id="statusTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Formulir</th>
                                    <th>Status</th>
                                    <th>Komentar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $formulir = [
                                    ['nama' => 'Data Diri', 'status' => $user->calonSiswa ? ($user->calonSiswa->status ?? 'belum diisi') : 'belum diisi', 'komentar' => $user->calonSiswa ? ($user->calonSiswa->komentar ?? '-') : '-', 'route' => 'calon-siswa.create', 'route_edit' => 'calon-siswa.edit', 'route_index' => 'calon-siswa.index', 'id' => $user->calonSiswa ? $user->calonSiswa->id : null],
                                    ['nama' => 'Alamat', 'status' => $user->calonSiswa && $user->calonSiswa->alamat ? ($user->calonSiswa->alamat->status ?? 'belum diisi') : 'belum diisi', 'komentar' => $user->calonSiswa && $user->calonSiswa->alamat ? ($user->calonSiswa->alamat->komentar ?? '-') : '-', 'route' => 'alamat.create', 'route_edit' => 'alamat.edit', 'route_index' => 'alamat.index', 'id' => $user->calonSiswa && $user->calonSiswa->alamat ? $user->calonSiswa->alamat->id : null],
                                    ['nama' => 'Data Orang Tua', 'status' => $user->calonSiswa && $user->calonSiswa->dataOrangTua ? ($user->calonSiswa->dataOrangTua->status ?? 'belum diisi') : 'belum diisi', 'komentar' => $user->calonSiswa && $user->calonSiswa->dataOrangTua ? ($user->calonSiswa->dataOrangTua->komentar ?? '-') : '-', 'route' => 'data-orang-tua.create', 'route_edit' => 'data-orang-tua.edit', 'route_index' => 'data-orang-tua.index', 'id' => $user->calonSiswa && $user->calonSiswa->dataOrangTua ? $user->calonSiswa->dataOrangTua->id : null],
                                    ['nama' => 'Data Rinci', 'status' => $user->calonSiswa && $user->calonSiswa->dataRinci ? ($user->calonSiswa->dataRinci->status ?? 'belum diisi') : 'belum diisi', 'komentar' => $user->calonSiswa && $user->calonSiswa->dataRinci ? ($user->calonSiswa->dataRinci->komentar ?? '-') : '-', 'route' => 'data-rinci.create', 'route_edit' => 'data-rinci.edit', 'route_index' => 'data-rinci.index', 'id' => $user->calonSiswa && $user->calonSiswa->dataRinci ? $user->calonSiswa->dataRinci->id : null],
                                    ['nama' => 'Berkas Pendidikan', 'status' => $user->calonSiswa && $user->calonSiswa->berkasPendidikan ? ($user->calonSiswa->berkasPendidikan->status ?? 'belum diisi') : 'belum diisi', 'komentar' => $user->calonSiswa && $user->calonSiswa->berkasPendidikan ? ($user->calonSiswa->berkasPendidikan->komentar ?? '-') : '-', 'route' => 'berkas-pendidikan.create', 'route_edit' => 'berkas-pendidikan.edit', 'route_index' => 'berkas-pendidikan.index', 'id' => $user->calonSiswa && $user->calonSiswa->berkasPendidikan ? $user->calonSiswa->berkasPendidikan->id : null],
                                ];
                            @endphp
                            @foreach($formulir as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data['nama'] }}</td>
                                    <td>
                                        @if ($data['status'] === 'Submitted')
                                            <span class="badge bg-primary text-light"><i class="bi bi-check-circle me-1"></i> Submitted</span>
                                        @elseif ($data['status'] === 'In Progress')
                                            <span class="badge bg-secondary text-light"><i class="bi bi-info-circle me-1"></i> In Progress</span>
                                        @elseif ($data['status'] === 'Requires Revision')
                                            <span class="badge bg-warning text-dark"><i class="bi bi-info-triangle me-1"></i> Requires Revision</span>
                                        @elseif ($data['status'] === 'Verified')
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Verified</span>
                                        @elseif ($data['status'] === 'Updated') 
                                            <span class="badge bg-info text-light"><i class="bi bi-pencil me-1"></i> Updated</span>
                                        @else
                                            <span class="badge bg-light text-dark"><i class="bi bi-x-circle me-1"></i> Belum Diisi</span>
                                        @endif
                                    </td>
                                    <td>{{ $data['komentar'] }}</td>
                                    <td>
                                        @if ($data['id'] === null)
                                            <!-- Tombol untuk mengarahkan ke halaman create jika data belum diisi -->
                                            <a href="{{ route($data['route']) }}" class="btn btn-primary btn-sm">Lengkapi Sekarang</a>
                                        @elseif ($data['status'] === 'Submitted')
                                            <span class="text-muted">-</span>
                                        @elseif ($data['status'] === 'Requires Revision')
                                            <a href="{{ route($data['route_edit'], ['id' => $data['id']]) }}" class="btn btn-warning btn-sm">Perbaiki Sekarang</a>
                                        @elseif ($data['status'] === 'Verified')
                                            <a href="{{ route($data['route_index']) }}" class="btn btn-success btn-sm">Lihat Rincian Data</a>
                                        @elseif ($data['status'] === 'Updated')
                                            <span class="text-muted">-</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>

                    @if ($allFormSubmitted && $isContactComplete)
                        <div class="mb-3">
                            <form action="{{ route('registration.submit') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm w-100">Kirim Pendaftaran Saya</button>
                            </form>
                        </div>
                    @else
                        <div class="mb-3">
                            <button class="btn btn-muted btn-sm w-100" disabled>Kirim Pendaftaran Saya</button>
                        </div>
                    @endif

                    @if ($hasUpdated)
                        <form action="{{ route('registration.update') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning">Kirim Perbaikan Data</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>

        <!-- Keterangan Status Pendaftaran -->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Keterangan Status Pendaftaran</h5>
                    <ul>
                        <li><strong>Submitted:</strong> Formulir telah lengkap dan dikirimkan untuk diproses lebih lanjut.</li>
                        <li><strong>In Progress:</strong> Formulir sedang diproses oleh tim PPDB.</li>
                        <li><strong>Requires Revision:</strong> Formulir perlu diperbaiki, karena terdapat informasi yang kurang atau salah.</li>
                        <li><strong>Verified:</strong> Formulir telah diverifikasi dan diterima oleh admin.</li>
                        <li><strong>Updated:</strong> Formulir telah diperbarui dan menunggu proses verifikasi lebih lanjut.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Cek apakah session flash ada
    @if (session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @elseif (session('already_submitted'))
        Swal.fire({
            title: 'Peringatan!',
            text: '{{ session('already_submitted') }}',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    @elseif (session('error'))
        Swal.fire({
            title: 'Kesalahan!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endpush
