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
    </div>

    <div class="row">
        <!-- Status Pendaftaran Saya -->
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
                                    ['nama' => 'Data Diri', 'status' => $user->calonSiswa->status ?? null, 'route' => 'data-diri.create'],
                                    ['nama' => 'Alamat', 'status' => $user->calonSiswa->alamat->status ?? null, 'route' => 'alamat.create'],
                                    ['nama' => 'Data Orang Tua', 'status' => $user->calonSiswa->dataOrangTua->status ?? null, 'route' => 'data-orang-tua.create'],
                                    ['nama' => 'Data Rinci', 'status' => $user->calonSiswa->dataRinci->status ?? null, 'route' => 'data-rinci.create'],
                                    ['nama' => 'Berkas Pendidikan', 'status' => $user->calonSiswa->berkasPendidikan->status ?? null, 'route' => 'berkas-pendidikan.create'],
                                    [
                                        'nama' => 'Pembayaran Formulir',
                                        'status' => $user->calonSiswa->payments->isNotEmpty() ? 'Submitted' : 'Belum Diisi',
                                        'route' => 'payments.edit',
                                        'payment' => $user->calonSiswa->payments->first()
                                    ]
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
                                            @elseif (isset($data['payment']) && $data['payment'] && $data['payment']->count() > 0)
                                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Pembayaran Diterima</span>
                                            @else
                                                <span class="badge bg-light text-dark"><i class="bi bi-x-circle me-1"></i>Belum Diisi</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($data['payment']) && $data['payment'] && $data['payment']->count() > 0)  
                                                <!-- Tidak ada tombol aksi jika pembayaran sudah diterima -->
                                                <span class="text-muted">-</span>  
                                            @elseif ($data['status'] === 'Submitted')
                                                <!-- Tidak ada tombol aksi jika formulir sudah disubmit -->
                                                <span class="text-muted">-</span>  
                                            @elseif ($data['status'] === 'Requires Revision')
                                                <!-- Tombol Edit jika formulir sudah disubmit dan memerlukan revisi -->
                                                <a href="{{ route($data['route']) }}" class="btn btn-warning btn-sm">Edit</a>  
                                            @elseif ($data['status'] === null)
                                                <!-- Tombol Lengkapi jika formulir belum diisi (status null) -->
                                                <a href="{{ route($data['route']) }}" class="btn btn-primary btn-sm">Lengkapi Sekarang</a>  
                                            @elseif (!isset($data['payment']) || (isset($data['payment']) && $data['payment']->count() === 0))
                                                <!-- Tombol Bayar Sekarang jika belum ada pembayaran -->
                                                <a href="{{ route('payments.paymentPage') }}" class="btn btn-primary btn-sm">Bayar Sekarang</a>  
                                            @else
                                                <span class="text-muted">-</span>  <!-- Tidak ada tombol aksi lainnya -->
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

        <!-- Keterangan Status -->
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

    <!-- Tombol Kirim Notifikasi -->
    <div class="row mt-3">
        <div class="col-lg-12">
        @if ($allFormSubmitted && $isContactComplete)
            <form action="{{ route('registration.submit') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Kirim Pendaftaran Saya</button>
            </form>
        @else
            <button class="btn btn-muted btn-sm" disabled>Kirim Pendaftaran Saya</button>
        @endif
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
