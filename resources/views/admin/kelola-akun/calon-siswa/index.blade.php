@extends('admin.layouts.admin-layout')

@section('title', 'Kelola Akun Siswa')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kelola Akun Siswa</h6>
        <button id="createSiswaBtn" class="btn btn-sm btn-primary float-right">
            <i class="fas fa-plus"></i> Tambah Akun Siswa
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="siswaDataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $siswa->name }}</td>
                            <td>{{ $siswa->email }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning editBtn" 
                                    data-id="{{ $siswa->id }}" 
                                    data-name="{{ $siswa->name }}" 
                                    data-email="{{ $siswa->email }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('admin.kelola-akun.siswa.destroy', $siswa->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger deleteBtn" onclick="return confirm('Yakin ingin menghapus akun ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
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
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function() {

        // Initialize DataTable
        $('#siswaDataTable').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/Indonesian.json"
            },
            columnDefs: [
                { orderable: false, targets: 3 }
            ]
        });

        // SweetAlert for Create
        $('#createSiswaBtn').on('click', function() {
            Swal.fire({
                title: 'Tambah Akun Siswa',
                icon: 'info',
                html: `
                    <div class="form-group">
                        <label for="siswaName">Nama</label>
                        <input type="text" id="siswaName" class="swal2-input" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="siswaEmail">Email</label>
                        <input type="email" id="siswaEmail" class="swal2-input" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="siswaPassword">Password</label>
                        <input type="password" id="siswaPassword" class="swal2-input" placeholder="Password">
                    </div>
                `,
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Simpan',
                preConfirm: () => {
                    const name = document.getElementById('siswaName').value;
                    const email = document.getElementById('siswaEmail').value;
                    const password = document.getElementById('siswaPassword').value;

                    if (!name || !email || !password) {
                        Swal.showValidationMessage('Semua field harus diisi!');
                        return false;
                    }

                    return fetch("{{ route('admin.kelola-akun.siswa.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ name, email, password })
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal menambahkan akun.');
                        return response.json();
                    })
                    .catch(error => Swal.showValidationMessage(`Terjadi kesalahan: ${error.message}`));
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Berhasil!', 'Akun berhasil ditambahkan.', 'success').then(() => location.reload());
                }
            });
        });

        // SweetAlert for Edit
        $(document).on('click', '.editBtn', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const email = $(this).data('email');

            Swal.fire({
                title: 'Edit Akun Siswa',
                icon: 'info',
                html: `
                    <div class="form-group">
                        <label for="editSiswaName">Nama</label>
                        <input type="text" id="editSiswaName" class="swal2-input" value="${name}">
                    </div>
                    <div class="form-group">
                        <label for="editSiswaEmail">Email</label>
                        <input type="email" id="editSiswaEmail" class="swal2-input" value="${email}">
                    </div>
                `,
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Simpan',
                preConfirm: () => {
                    const updatedName = document.getElementById('editSiswaName').value;
                    const updatedEmail = document.getElementById('editSiswaEmail').value;

                    if (!updatedName || !updatedEmail) {
                        Swal.showValidationMessage('Semua field harus diisi!');
                        return false;
                    }

                    return fetch(`{{ route('admin.kelola-akun.siswa.update', '') }}/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ name: updatedName, email: updatedEmail })
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal mengupdate akun.');
                        return response.json();
                    })
                    .catch(error => Swal.showValidationMessage(`Terjadi kesalahan: ${error.message}`));
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Berhasil!', 'Akun berhasil diperbarui.', 'success').then(() => location.reload());
                }
            });
        });
    });
    </script>
@endpush
