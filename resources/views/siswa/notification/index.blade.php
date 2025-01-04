@extends('siswa.layouts.siswa-layout')

@section('title', 'Daftar Kontak Notifikasi')

@section('content')
<div class="pagetitle">
    <h1>Kontak Notifikasi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Kontak Notifikasi</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <!-- Info Message -->
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                <strong>Catatan:</strong> Untuk menerima notifikasi penting dari kami, harap sertakan email dan nomor WhatsApp yang dapat dihubungi. Kontak ini akan digunakan untuk pengiriman notifikasi seperti konfirmasi pendaftaran dan informasi lainnya.
            </div>
        </div>

        <!-- Menampilkan Kontak -->
        @if($notificationContact)
        <div class="col-lg-4 col-md-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Kontak Notifikasi</h5>
                    <p><strong>Email:</strong> {{ $notificationContact->email ?? 'N/A' }}</p>
                    <p><strong>WhatsApp:</strong> {{ $notificationContact->whatsapp ?? 'N/A' }}</p>

                    <hr>
                    <!-- Edit Button -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                    <!-- Delete Button -->
                    <form action="{{ route('notification.destroy', $notificationContact->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Kontak -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Kontak Notifikasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('notification.update', $notificationContact->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $notificationContact->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">WhatsApp</label>
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ $notificationContact->whatsapp }}" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @else
        <!-- Jika tidak ada data -->
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                Belum ada data kontak notifikasi. <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Kontak Notifikasi</a>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Modal Create Kontak -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Kontak Notifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('notification.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="whatsapp" class="form-label">WhatsApp</label>
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
