@extends('admin.layouts.admin-layout')

@section('title', 'Daftar Pendaftar')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Semua Pendaftaran</h5>
        <p class="mt-2 text-muted" style="font-size: 1rem;">
            Di sini Anda dapat melihat semua data pendaftar yang telah mengirimkan formulir pendaftaran, serta menambahkan komentar atau melakukan aksi lainnya.
            Termasuk melihat data pendaftaran yang sudah diterima dan menghapus data pendaftar jika diperlukan.
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
                                <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $p->id }}" data-name="{{ $p->calonSiswa->nama_lengkap ?? 'Pendaftar' }}">
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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
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
                    { orderable: false, targets: [5, 6] }
                ],
                responsive: true
            });

            // Menambahkan event listener untuk tombol hapus
            $('.deleteBtn').click(function(e) {
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
                                    location.reload();  // Reload halaman setelah berhasil menghapus
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
