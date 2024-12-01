@extends('siswa.layouts.siswa-layout')

@section('title', 'Daftar Data Diri Calon Siswa')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-3">
        <div class="card-header">
            <h5 class="mb-0">Daftar Data Diri Calon Siswa</h5>
        </div>
        <div class="card-body">
            <!-- Tombol untuk menambah data diri -->
            <a href="{{ route('calon-siswa.create') }}" class="btn btn-primary mb-3">Tambah Data Diri</a>
            
            <!-- Cek apakah ada data calon siswa -->
            @if($dataDiri)
                <!-- Tabel Data Diri Calon Siswa -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Nomor HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $dataDiri->nama_lengkap }}</td>
                            <td>{{ $dataDiri->tempat_lahir }}</td>
                            <td>{{ $dataDiri->tanggal_lahir }}</td>
                            <td>{{ ucfirst($dataDiri->jenis_kelamin) }}</td>
                            <td>{{ ucfirst($dataDiri->agama) }}</td>
                            <td>{{ $dataDiri->no_hp }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('calon-siswa.edit') }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('calon-siswa.destroy') }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @else
                <!-- Jika tidak ada data -->
                <div class="alert alert-warning" role="alert">
                    Belum ada data calon siswa.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
