@extends('admin.layouts.admin-layout')

@section('title', 'Verifikasi Pendaftaran')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Verifikasi Pendaftaran</h5>
        <p class="mt-2 text-muted" style="font-size: 1rem;">
            Di sini Anda dapat melihat data pendaftar dengan status "Submitted" dan "Updated". Segera lakukan verifikasi-pendaftaran agar Calon Siswa tidak menunggu lama.
        </p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="pendaftarTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No Registrasi</th>
                        <th>Nama Lengkap</th>
                        <th>Asal Sekolah</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Status</th>
                        <th>Komentar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftar as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->calonSiswa->nama_lengkap ?? '-' }}</td>
                            <td>{{ $p->dataRinci->asal_sekolah ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y, H:i') }}</td>
                            <td>{{ ucfirst($p->status) }}</td>
                            <td>{{ $p->komentar ?? 'Belum ada komentar.' }}</td>
                            <td>
                                <a href="{{ route('admin.verifikasi-pendaftaran.show', $p->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Lihat Detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <!-- Tombol Hapus -->
                                <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $p->id }}">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $pendaftar->links() }}
        </div>
    </div>
</div>
@endsection
