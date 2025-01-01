@extends('admin.layouts.admin-layout')

@section('title', 'Kelola Kontak WhatsApp Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kelola Kontak WhatsApp Admin</h6>
    </div>
    <div class="card-body">
        <!-- Menampilkan WhatsApp jika ada -->
        @if($admin->whatsapp)
            <div class="form-group">
                <label for="whatsapp">Nomor WhatsApp Admin</label>
                <input type="text" id="whatsapp" class="form-control" value="{{ $admin->whatsapp }}" disabled>
            </div>
        @else
            <p>Tidak ada data nomor WhatsApp. Silakan tambahkan nomor WhatsApp.</p>
        @endif

        <!-- Form untuk menambahkan atau mengupdate WhatsApp -->
        <form action="{{ route('admin.admin-contact.whatsapp.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="whatsapp">Masukkan Nomor WhatsApp Admin</label>
                <input type="text" id="whatsapp" name="whatsapp" class="form-control" value="{{ old('whatsapp', $admin->whatsapp) }}" required>
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
