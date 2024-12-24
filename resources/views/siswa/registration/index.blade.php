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
        <!-- Informasi Calon Siswa dan Kontak -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi Calon Siswa</h5>
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
                        <div class="col-lg-8">{{ $user->notificationContact->no_hp ?? 'Belum ada nomor telepon' }}</div>
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
    </div>

    <div class="row">
        <!-- Status Pendaftaran Saya (Left) -->
        <div class="col-lg-8">
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $formulir = [
                                    ['nama' => 'Data Diri', 'status' => $user->calonSiswa->status ?? null, 'route' => 'data-diri.edit'],
                                    ['nama' => 'Alamat', 'status' => $user->calonSiswa->alamat->status ?? null, 'route' => 'alamat.edit'],
                                    ['nama' => 'Data Orang Tua', 'status' => $user->calonSiswa->dataOrangTua->status ?? null, 'route' => 'data-orang-tua.edit'],
                                    ['nama' => 'Data Rinci', 'status' => $user->calonSiswa->dataRinci->status ?? null, 'route' => 'data-rinci.edit'],
                                    ['nama' => 'Berkas Pendidikan', 'status' => $user->calonSiswa->berkasPendidikan->status ?? null, 'route' => 'berkas-pendidikan.edit'],
                                    ['nama' => 'Pembayaran Formulir', 'status' => $user->calonSiswa->payments->first()?->status ?? null, 'route' => 'payments.edit']
                                ];
                                @endphp
                                @foreach($formulir as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data['nama'] }}</td>
                                        <td>
                                            @if ($data['status'] === 'Submitted')
                                                <span class="badge bg-primary text-light"><i class="bi bi-check-circle me-1"></i>Submitted</span>
                                            @elseif ($data['status'] === 'In Progress')
                                                <span class="badge bg-secondary text-light"><i class="bi bi-info-circle me-1"></i>In Progress</span>
                                            @elseif ($data['status'] === 'Requires Revision')
                                                <span class="badge bg-warning text-dark"><i class="bi bi-info-triangle me-1"></i>Requires Revision</span>
                                            @elseif ($data['status'] === 'Verified')
                                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Verified</span>
                                            @else
                                                <span class="badge bg-light text-dark"><i class="bi bi-x-circle me-1"></i>Belum Diisi</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data['status'] === 'Requires Revision')
                                                <a href="{{ route($data['route']) }}" class="btn btn-warning btn-sm">Edit</a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Keterangan Status (Right) -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Keterangan Status</h5>
                    <p class="text-muted">Berikut adalah keterangan status formulir yang dapat Anda temui di sistem:</p>
                    <ul>
                        <li><span class="badge bg-primary text-light"><i class="bi bi-check-circle me-1"></i>Submitted</span> - Formulir telah dikirimkan dan menunggu verifikasi.</li>
                        <li><span class="badge bg-secondary text-light"><i class="bi bi-info-circle me-1"></i>In Progress</span> - Formulir sedang dalam proses pengecekan.</li>
                        <li><span class="badge bg-warning text-dark"><i class="bi bi-info-triangle me-1"></i>Requires Revision</span> - Formulir memerlukan revisi sebelum diproses lebih lanjut.</li>
                        <li><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Verified</span> - Formulir telah diverifikasi dan siap untuk tahap selanjutnya.</li>
                        <li><span class="badge bg-light text-dark"><i class="bi bi-x-circle me-1"></i>Belum Diisi</span> - Formulir belum diisi, silakan lengkapi formulir tersebut.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
