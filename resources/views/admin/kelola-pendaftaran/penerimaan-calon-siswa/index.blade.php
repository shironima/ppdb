@extends('admin.layouts.admin-layout')

@section('title', 'Daftar Pendaftar')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Pendaftaran Siswa Baru</h5>
        <p class="mt-2 text-muted" style="font-size: 1rem;">
            Ini adalah halaman terakhir untuk memverifikasi pendaftaran calon siswa baru apakah calon siswa tersebut diterima atau tidak.
        </p>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="status">Filter Status</label>
            <select id="status" name="status" class="form-control">
                <option value="">Semua</option>
                <option value="Submitted">Submitted</option>
                <option value="Updated">Updated</option>
                <option value="Accepted">Accepted</option>
                <option value="Requires Revision">Requires Revision</option>
            </select>
        </div>

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
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Tambahkan Library SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    var table = $('#pendaftarTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('verifikasi-pendaftaran.index') }}',
            data: function(d) {
                d.status = $('#status').val(); // Mengirim status yang dipilih ke server
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            { data: 'asal_sekolah', name: 'asal_sekolah' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
            { data: 'komentar', name: 'komentar' },
            {
                data: null,
                orderable: false,
                render: function(data) {
                    return `<a href="{{ url('verifikasi-pendaftaran') }}/${data.id}" class="btn btn-sm btn-info">
                               <i class="fas fa-eye"></i> Detail
                           </a>
                           <button class="btn btn-sm btn-danger deleteBtn" data-id="${data.id}" data-name="${data.nama_lengkap}">
                               <i class="fas fa-trash"></i> Hapus
                           </button>`;
                }
            }
        ],
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
        }
    });

    // Ketika status filter diubah
    $('#status').change(function() {
        table.ajax.reload();  // Memuat ulang data dengan status baru
    });

    // SweetAlert untuk Konfirmasi Hapus
    $('#pendaftarTable').on('click', '.deleteBtn', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Data pendaftaran ${name} akan dihapus secara permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/verifikasi-pendaftaran/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // Kirim token CSRF
                    },
                    success: function(result) {
                        table.ajax.reload(); // Reload data di tabel
                        Swal.fire(
                            'Dihapus!',
                            'Data pendaftaran berhasil dihapus.',
                            'success'
                        );
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>
@endpush