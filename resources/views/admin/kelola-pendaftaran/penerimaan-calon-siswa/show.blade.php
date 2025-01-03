@extends('admin.layouts.admin-layout')

@section('title', 'Detail Pendaftar')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Detail Pendaftar</h5>
    </div>
    <div class="card-body">
        <h6>Informasi Calon Siswa</h6>
        <table class="table table-bordered">
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $registration->calonSiswa->nama_lengkap }}</td>
            </tr>
            <tr>
                <th>Asal Sekolah</th>
                <td>{{ $registration->dataRinci->asal_sekolah }}</td>
            </tr>
        </table>

        <h6>Status Pendaftaran</h6>
        
        <form id="update-form" action="{{ route('verifikasi-pendaftaran.update', $registration->id) }}" method="POST">
            @csrf
            @method('PUT')
            <table class="table table-bordered">
                <tr>
                    <th>Status</th>
                    <td>
                        <select name="status" class="form-control">
                            <option value="submitted" {{ $registration->status == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                            <option value="updated" {{ $registration->status == 'Updated' ? 'selected' : '' }}>Updated</option>
                            <option value="accepted" {{ $registration->status == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Komentar</th>
                    <td>
                        <textarea name="komentar" class="form-control" rows="4">{{ $registration->komentar }}</textarea>
                    </td>
                </tr>
            </table>
            <button type="button" id="submit-btn" class="btn btn-primary mt-3">Simpan Perubahan</button>
        </form>

        <h6 class="mt-4">Detail Komponen Pendaftaran</h6>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Komponen</th>
                    <th>Status</th>
                    <th>Komentar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Calon Siswa</td>
                    <td>{{ ucfirst($registration->calonSiswa->status ?? 'N/A') }}</td>
                    <td>{{ $registration->calonSiswa->komentar ?? 'Belum ada komentar.' }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>{{ ucfirst($registration->alamat->status ?? 'N/A') }}</td>
                    <td>{{ $registration->alamat->komentar ?? 'Belum ada komentar.' }}</td>
                </tr>
                <tr>
                    <td>Data Orang Tua</td>
                    <td>{{ ucfirst($registration->dataOrangTua->status ?? 'N/A') }}</td>
                    <td>{{ $registration->dataOrangTua->komentar ?? 'Belum ada komentar.' }}</td>
                </tr>
                <tr>
                    <td>Data Rinci</td>
                    <td>{{ ucfirst($registration->dataRinci->status ?? 'N/A') }}</td>
                    <td>{{ $registration->dataRinci->komentar ?? 'Belum ada komentar.' }}</td>
                </tr>
                <tr>
                    <td>Berkas Pendidikan</td>
                    <td>{{ ucfirst($registration->berkasPendidikan->status ?? 'N/A') }}</td>
                    <td>{{ $registration->berkasPendidikan->komentar ?? 'Belum ada komentar.' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('submit-btn').addEventListener('click', function () {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menyimpan perubahan?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('update-form').submit();
            }
        });
    });

    // Tampilkan SweetAlert untuk notifikasi sukses atau error
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
        });
    @elseif($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ $errors->first() }}',
        });
    @endif
</script>
@endpush