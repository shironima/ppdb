@extends('admin.layouts.admin-layout')

@section('title', 'Daftar Pendaftar')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Pendaftaran Siswa Baru</h5>
        <p class="mt-2 text-muted" style="font-size: 1rem;">
            Di sini Anda dapat melihat semua data pendaftar yang telah mengirimkan formulir pendaftaran, serta menambahkan komentar atau melakukan aksi lainnya.
            Termasuk melihat data pendaftaran yang sudah diterima dan menghapus data pendaftar jika diperlukan.
        </p>
    </div>
    <div class="card-body">
        <!-- Filter Status -->
        <div class="form-group">
            <label for="status">Filter Status</label>
            <select id="status" name="status" class="form-control">
                <option value="">Semua</option>
                <option value="submitted">Submitted</option>
                <option value="updated">Updated</option>
                <option value="verified">Verified</option>
                <option value="requires_revision">Requires Revision</option>
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
                <tbody>
                    <!-- Data akan dimuat lewat AJAX -->
                </tbody>
            </table>
        </div>
        <div class="mt-3" id="paginationLinks">
            <!-- Pagination Links will be handled by DataTables -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    var table = $('#pendaftarTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('admin.verifikasi-pendaftaran.index') }}',
            data: function(d) {
                d.status = $('#status').val();  // Menambahkan status filter
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nama_lengkap', name: 'calonSiswa.nama_lengkap' },
            { data: 'asal_sekolah', name: 'dataRinci.asal_sekolah' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
            { data: 'komentar', name: 'komentar' },
            {
                data: null,
                render: function(data) {
                    return `<a href="{{ url('admin/verifikasi-pendaftaran') }}/${data.id}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Lihat Detail">
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
        },
        columnDefs: [
            { orderable: false, targets: [5, 6] }
        ],
        responsive: true
    });

    // Ketika status filter berubah, reload tabel
    $('#status').change(function() {
        table.ajax.reload();
    });

    // Menambahkan event listener untuk tombol hapus
    $(document).on('click', '.deleteBtn', function(e) {
        e.preventDefault();  // Mencegah form di-submit langsung

        var id = $(this).data('id');
        var name = $(this).data('name');  // Nama pendaftar diambil dari data-name

        // Menampilkan SweetAlert konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data pendaftar " + name + " akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Batal', 
            confirmButtonText: 'Hapus',  
            confirmButtonColor: '#3085d6',  
            cancelButtonColor: '#d33',  
            reverseButtons: false,  
        })
        .then((result) => {
            if (result.isConfirmed) {
                // Melakukan penghapusan menggunakan fetch API
                fetch(`{{ route('admin.verifikasi-pendaftaran.destroy', ':id') }}`.replace(':id', id), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire(
                            'Hapus Berhasil!',
                            'Data pendaftar telah dihapus.',
                            'success'
                        ).then(() => {
                            table.ajax.reload(); 
                        });
                    } else {
                        Swal.fire(
                            'Terjadi Kesalahan!',
                            'Data pendaftar gagal dihapus.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    Swal.fire(
                        'Terjadi Kesalahan!',
                        'Gagal menghubungi server.',
                        'error'
                    );
                });
            }
        });
    });

    // Aktivasi tooltips untuk tombol
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush
