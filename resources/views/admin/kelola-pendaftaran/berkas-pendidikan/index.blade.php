@extends('admin.layouts.admin-layout')

@section('title', 'Daftar Berkas Pendidikan')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Berkas Pendidikan</h5>
        <p class="mt-2 text-muted" style="font-size: 1rem;">
            Di sini Anda dapat melihat semua berkas pendidikan yang telah diunggah oleh pendaftar, serta menambahkan komentar atau melakukan aksi lainnya.
            Termasuk melihat detail berkas pendidikan yang perlu diverifikasi atau menghapus berkas jika diperlukan.
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
            <table class="table table-striped table-bordered" id="berkasPendidikanTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No Registrasi</th>
                        <th>Nama Calon Siswa</th>
                        <th>Status Berkas Pendidikan</th>
                        <th>Tanggal Unggah</th>
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
            // Inisialisasi DataTables
            var table = $('#berkasPendidikanTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.verifikasi-berkas-pendidikan.index') }}',
                    data: function(d) {
                        d.status = $('#status').val();  // Mengirimkan filter status ke server
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nama_lengkap', name: 'calonSiswa.nama_lengkap' },
                    { data: 'status', name: 'berkasPendidikan.status' },
                    { data: 'created_at', name: 'berkasPendidikan.created_at' },
                    { data: 'komentar', name: 'berkasPendidikan.komentar' },
                    {
                        data: null,
                        render: function(data) {
                            return `<a href="{{ url('admin/verifikasi-berkas-pendidikan') }}/${data.id}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Lihat Detail">
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
                    { orderable: false, targets: [4, 5] }
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
                    text: "Data berkas pendidikan pendaftar " + name + " akan dihapus!",
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
                        fetch(`{{ route('admin.verifikasi-berkas-pendidikan.destroy', ':id') }}`.replace(':id', id), {
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
                                    'Data berkas pendidikan telah dihapus.',
                                    'success'
                                ).then(() => {
                                    table.ajax.reload(); 
                                });
                            } else {
                                Swal.fire(
                                    'Terjadi Kesalahan!',
                                    'Data berkas pendidikan gagal dihapus.',
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
