@extends('admin.layouts.admin-layout')

@section('title', 'Tambah WhatsApp Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah WhatsApp Admin</h6>
    </div>
    <div class="card-body">
        <!-- Form untuk menambahkan WhatsApp -->
        <form action="{{ route('admin.admin-contact.store.whatsapp') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="whatsapp">Masukkan Nomor WhatsApp Admin</label>
                <input type="text" id="whatsapp" name="whatsapp" class="form-control" value="{{ old('whatsapp') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan WhatsApp</button>
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
