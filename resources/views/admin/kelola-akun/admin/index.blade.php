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
                                <form action="{{ route('admin.kelola-akun.admin.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus akun ini?')">
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
                icon: 'info',
                html: `
                    <div class="form-group">
                        <label for="adminName">Nama</label>
                        <input type="text" id="adminName" class="swal2-input" placeholder="Nama" style="border: 2px solid #007bff; padding: 10px; font-size: 14px; border-radius: 5px;">
                    </div>
                    <div class="form-group">
                        <label for="adminEmail">Email</label>
                        <input type="email" id="adminEmail" class="swal2-input" placeholder="Email" style="border: 2px solid #007bff; padding: 10px; font-size: 14px; border-radius: 5px;">
                    </div>
                    <div class="form-group">
                        <label for="adminPassword">Password</label>
                        <input type="password" id="adminPassword" class="swal2-input" placeholder="Password" style="border: 2px solid #007bff; padding: 10px; font-size: 14px; border-radius: 5px;">
                    </div>
                `,
                showCancelButton: true,
                cancelButtonText: 'Batal',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Simpan',
                confirmButtonColor: '#3085d6',
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
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal menambahkan akun.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        return data; // Return the response data for success message handling
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Terjadi kesalahan: ${error.message}`);
                        return false; // Ensure that the preConfirm doesn't proceed if error occurs
                    });
                },
                willOpen: () => {
                    // Styling for enhanced appearance
                    document.querySelector('.swal2-title').style.fontFamily = "'Roboto', sans-serif";
                    document.querySelector('.swal2-popup').style.borderRadius = '10px';
                    document.querySelector('.swal2-input').style.borderRadius = '8px';
                    document.querySelector('.swal2-confirm').style.borderRadius = '8px';
                    document.querySelector('.swal2-cancel').style.borderRadius = '8px';
                    document.querySelector('.swal2-popup').style.padding = '20px';
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
                icon: 'info',
                html: `
                    <div class="form-group">
                        <label for="adminName">Nama</label>
                        <input type="text" id="adminName" class="swal2-input" value="${name}" style="border: 2px solid #007bff; padding: 10px; font-size: 14px; border-radius: 5px;">
                    </div>
                    <div class="form-group">
                        <label for="adminEmail">Email</label>
                        <input type="email" id="adminEmail" class="swal2-input" value="${email}" style="border: 2px solid #007bff; padding: 10px; font-size: 14px; border-radius: 5px;">
                    </div>
                `,
                showCancelButton: true,
                cancelButtonText: 'Batal',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Simpan',
                confirmButtonColor: '#3085d6',
                preConfirm: () => {
                    const updatedName = document.getElementById('adminName').value;
                    const updatedEmail = document.getElementById('adminEmail').value;

                    if (!updatedName || !updatedEmail) {
                        Swal.showValidationMessage('Semua field harus diisi!');
                        return false;
                    }

                    return fetch(`{{ route('admin.kelola-akun.admin.update', '') }}/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ name: updatedName, email: updatedEmail })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal mengupdate akun.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        return data; // Return the response data for success message handling
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Terjadi kesalahan: ${error.message}`);
                        return false; // Ensure that the preConfirm doesn't proceed if error occurs
                    });
                },
                willOpen: () => {
                    // Styling for enhanced appearance
                    document.querySelector('.swal2-title').style.fontFamily = "'Roboto', sans-serif";
                    document.querySelector('.swal2-popup').style.borderRadius = '10px';
                    document.querySelector('.swal2-input').style.borderRadius = '8px';
                    document.querySelector('.swal2-confirm').style.borderRadius = '8px';
                    document.querySelector('.swal2-cancel').style.borderRadius = '8px';
                    document.querySelector('.swal2-popup').style.padding = '20px';
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Berhasil!', 'Akun berhasil diperbarui.', 'success').then(() => {
                        location.reload();
                    });
                }
            });
        });
    });
    </script>
@endpush
