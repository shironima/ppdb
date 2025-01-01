@extends('admin.layouts.admin-layout')

@section('title', 'Kelola Kontak Email Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kelola Kontak Email Admin</h6>
    </div>
    <div class="card-body">
        <!-- Menampilkan email jika ada -->
        @if($admin->email)
            <div class="form-group">
                <label for="email">Email Admin</label>
                <input type="email" id="email" class="form-control" value="{{ $admin->email }}" disabled>
            </div>
        @else
            <p>Tidak ada data email. Silakan tambahkan email.</p>
        @endif

        <!-- Form untuk menambahkan atau mengupdate email -->
        <form action="{{ route('admin.admin-contact.email.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="email">Masukkan Email Admin</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Email</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
@if(session('success'))
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if(session('warning'))
    <script>
        Swal.fire({
            title: 'Peringatan!',
            text: '{{ session('warning') }}',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endpush

