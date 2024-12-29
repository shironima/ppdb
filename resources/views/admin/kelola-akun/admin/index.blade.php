@extends('admin.layouts.admin-layout')

@section('title', 'Kelola Akun Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kelola Akun Admin</h6>
        <button id="createAdminBtn" class="btn btn-sm btn-primary float-right">
            <i class="fas fa-plus"></i> Tambah Akun Admin
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="adminDataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning editBtn" data-id="{{ $admin->id }}" data-name="{{ $admin->name }}" data-email="{{ $admin->email }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $admin->id }}">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#adminDataTable').DataTable({
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
            { orderable: false, targets: 3 }
        ]
    });

    // SweetAlert for Create
    $('#createAdminBtn').on('click', function() {
        Swal.fire({
            title: 'Tambah Akun Admin',
            html: `
                <input type="text" id="adminName" class="swal2-input" placeholder="Nama">
                <input type="email" id="adminEmail" class="swal2-input" placeholder="Email">
                <input type="password" id="adminPassword" class="swal2-input" placeholder="Password">
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            preConfirm: () => {
                const name = document.getElementById('adminName').value;
                const email = document.getElementById('adminEmail').value;
                const password = document.getElementById('adminPassword').value;

                if (!name || !email || !password) {
                    Swal.showValidationMessage('Semua field harus diisi!');
                    return false;
                }

                return fetch("{{ route('admin.kelola-akun.admin.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name, email, password })
                }).then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw new Error(err.message || 'Gagal menambahkan akun.') });
                    }
                    return response.json();
                }).catch(error => {
                    Swal.showValidationMessage(`Terjadi kesalahan: ${error.message}`);
                    return false;
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Berhasil!', 'Akun berhasil ditambahkan.', 'success').then(() => {
                    location.reload();
                });
            }
        });
    });

    // SweetAlert for Edit
    $(document).on('click', '.editBtn', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const email = $(this).data('email');

        Swal.fire({
            title: 'Edit Akun Admin',
            html: `
                <input type="text" id="adminName" class="swal2-input" value="${name}">
                <input type="email" id="adminEmail" class="swal2-input" value="${email}">
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            preConfirm: () => {
                const updatedName = document.getElementById('adminName').value;
                const updatedEmail = document.getElementById('adminEmail').value;

                if (!updatedName || !updatedEmail) {
                    Swal.showValidationMessage('Semua field harus diisi!');
                    return false;
                }

                return fetch(`{{ route('admin.kelola-akun.admin.update', ':id') }}`.replace(':id', id), {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name: updatedName, email: updatedEmail })
                }).then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw new Error(err.message || 'Gagal mengupdate akun.') });
                    }
                    return response.json();
                }).catch(error => {
                    Swal.showValidationMessage(`Terjadi kesalahan: ${error.message}`);
                    return false;
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Berhasil!', 'Akun berhasil diperbarui.', 'success').then(() => {
                    location.reload();
                });
            }
        });
    });

    // SweetAlert for Delete
    $(document).on('click', '.deleteBtn', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Yakin ingin menghapus akun ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            preConfirm: () => {
                return fetch(`{{ route('admin.kelola-akun.admin.destroy', ':id') }}`.replace(':id', id), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw new Error(err.message || 'Gagal menghapus akun.') });
                    }
                    return response.json();
                }).catch(error => {
                    Swal.showValidationMessage(`Terjadi kesalahan: ${error.message}`);
                    return false;
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Berhasil!', 'Akun berhasil dihapus.', 'success').then(() => {
                    location.reload();
                });
            }
        });
    });
});
</script>
@endpush
