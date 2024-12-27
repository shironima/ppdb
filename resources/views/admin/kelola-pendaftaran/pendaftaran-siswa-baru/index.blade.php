@extends('admin.layouts.admin-layout')

@section('title', 'Daftar Pendaftar')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pendaftar</h6>
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
                            <td>
                                @if($p->komentar)
                                    <span class="badge bg-info" data-toggle="tooltip" title="{{ $p->komentar }}">{{ substr($p->komentar, 0, 30) }}</span>
                                @else
                                    <span class="badge bg-secondary">Belum ada komentar</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.verifikasi-pendaftaran.show', $p->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Lihat Detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <form action="{{ route('admin.verifikasi-pendaftaran.destroy', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')" data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
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

@push('scripts')
<script>
    $(document).ready(function() {
        // Activate the DataTable plugin
        $('#pendaftarTable').DataTable({
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(disaring dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            },
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
            responsive: true
        });

        // Activate tooltips for buttons
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush
