@extends('siswa.layouts.siswa-layout')

@section('title', 'Profil')

@section('content')
<div class="pagetitle">
    <h1>Profil Akun Calon Siswa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Profil Akun</li>
        </ol>
    </nav>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ubah Informasi Profil</h4>
                </div>
                <div class="card-body">
                    <!-- Form Edit Profil -->
                    <form action="{{ route('siswa.profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- Nama -->
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', auth()->user()->name) }}" 
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', auth()->user()->email) }}" 
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group mt-3">
                            <label for="password">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password"
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="form-group mt-3">
                            <label for="password_confirmation">Konfirmasi Password Baru</label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password_confirmation" 
                                name="password_confirmation"
                            >
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
                    </form>

                    <!-- Form Hapus Akun -->
                    <form action="{{ route('siswa.profile.destroy') }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                            Hapus Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- SweetAlert -->
@push('scripts')
<script>
    @if(session('status') === 'profile-updated')
    Swal.fire({
        title: 'Berhasil!',
        text: 'Profil Anda telah diperbarui.',
        icon: 'success',
        confirmButtonText: 'OK'
    });
    @elseif(session('status') === 'account-deleted')
    Swal.fire({
        title: 'Akun Dihapus!',
        text: 'Akun Anda telah berhasil dihapus.',
        icon: 'success',
        confirmButtonText: 'OK'
    });
    @elseif(session('error'))
    Swal.fire({
        title: 'Error!',
        text: '{{ session('error') }}',
        icon: 'error',
        confirmButtonText: 'OK'
    });
    @endif
</script>
@endpush
