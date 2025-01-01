@extends('admin.layouts.admin-layout')

@section('title', 'Tambah Email Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Email Admin</h6>
    </div>
    <div class="card-body">
        <!-- Form untuk menambahkan email -->
        <form action="{{ route('admin.admin-contact.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Masukkan Email Admin</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
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
