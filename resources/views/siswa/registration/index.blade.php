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
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Rincian Informasi Calon Siswa</h5>
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

        <!-- Card untuk Kirim Pendaftaran Saya -->
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kirim Pendaftaran Saya</h5>
                    <ul>
                        <li>Setelah Anda mengisi semua formulir dengan lengkap, Anda dapat mengirimkan pendaftaran Anda untuk diproses lebih lanjut.</li>
                        <li>Tombol <badge>Kirim Pendaftaran Saya</badge> akan aktif ketika semua formulir telah diisi dengan benar dan informasi kontak lengkap.</li>
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
        <div class="col-lg-7">
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
                                    ['nama' => 'Data Diri', 'status' => $user->calonSiswa->status ?? null, 'route' => 'calon-siswa.create', 'route_edit' => 'calon-siswa.edit', 'route_index' => 'calon-siswa.index', 'id' => $user->calonSiswa->id],
                                    ['nama' => 'Alamat', 'status' => $user->calonSiswa->alamat->status ?? null, 'route' => 'alamat.create', 'route_edit' => 'alamat.edit', 'route_index' => 'alamat.index', 'id' => $user->calonSiswa->alamat->id],
                                    ['nama' => 'Data Orang Tua', 'status' => $user->calonSiswa->dataOrangTua->status ?? null, 'route' => 'data-orang-tua.create', 'route_edit' => 'data-orang-tua.edit', 'route_index' => 'data-orang-tua.index', 'id' => $user->calonSiswa->dataOrangTua->id],
                                    ['nama' => 'Data Rinci', 'status' => $user->calonSiswa->dataRinci->status ?? null, 'route' => 'data-rinci.create', 'route_edit' => 'data-rinci.edit', 'route_index' => 'data-rinci.index', 'id' => $user->calonSiswa->dataRinci->id],
                                    ['nama' => 'Berkas Pendidikan', 'status' => $user->calonSiswa->berkasPendidikan->status ?? null, 'route' => 'berkas-pendidikan.create', 'route_edit' => 'berkas-pendidikan.edit', 'route_index' => 'berkas-pendidikan.index', 'id' => $user->calonSiswa->berkasPendidikan->id],
                                    [
                                        'nama' => 'Pembayaran Formulir',
                                        'status' => ($user->calonSiswa->payments && $user->calonSiswa->payments->where('transaction_status', 'settlement')->count() > 0) ? 'Submitted' : 'Belum Diisi',
                                        'route' => 'payments.edit',
                                        'route_edit' => 'payments.edit',
                                        'route_index' => 'payments.index',
                                        'payment' => $user->calonSiswa->payments->first(),
                                        'id' => $user->calonSiswa->payments->first() ? $user->calonSiswa->payments->first()->id : null, // Pastikan 'id' pembayaran ada
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
                                        @elseif (isset($data['payment']) && $data['payment'])
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Pembayaran Diterima</span>
                                        @else
                                            <span class="badge bg-light text-dark"><i class="bi bi-x-circle me-1"></i>Belum Diisi</span>
                                        @endif
                                    </td>
                                    <td>
                                    @if ($data['status'] === 'Submitted')
                                            <span class="text-muted">-</span>  
                                        @elseif ($data['status'] === 'Requires Revision')
                                            <a href="{{ route($data['route_edit'], ['id' => $data['id']]) }}" class="btn btn-warning btn-sm">Perbaiki Sekarang</a>  
                                        @elseif ($data['status'] === 'Verified')
                                            <a href="{{ route($data['route_index']) }}" class="btn btn-success btn-sm">Lihat Rincian Data</a>  
                                        @elseif ($data['status'] === null)
                                            <a href="{{ route($data['route']) }}" class="btn btn-primary btn-sm">Lengkapi Sekarang</a>  
                                        @elseif (!isset($data['payment']) || !$data['payment'])
                                            <a href="{{ route('payments.paymentPage') }}" class="btn btn-primary btn-sm">Bayar Sekarang</a>  
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
                        <form action="{{ route('registration.submit') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm w-100">Kirim Pendaftaran Saya</button>
                        </form>
                    @else
                        <button class="btn btn-muted btn-sm w-100" disabled>Kirim Pendaftaran Saya</button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Keterangan Status -->
        <div class="col-lg-5">
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
