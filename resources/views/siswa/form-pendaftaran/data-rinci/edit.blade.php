@extends('siswa.layouts.siswa-layout')

@section('title', 'Formulir Edit Data Rinci Calon Siswa')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Formulir Edit Data Rinci Calon Siswa</h3>
        </div>
        <div class="card-body">
            <!-- Notifikasi SweetAlert -->
            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 2000
                    });
                </script>
            @elseif($errors->any())
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terdapat beberapa kesalahan pada pengisian form.',
                    });
                </script>
            @elseif(session('warning'))
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: '{{ session('warning') }}',
                    });
                </script>
            @endif

            <!-- Informasi Status -->
            <div class="alert alert-info">
                Status Data: <strong>{{ ucfirst($dataRinci->status) }}</strong>
            </div>

            <form action="{{ route('data-rinci.update', $dataRinci->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Laravel directive untuk PUT request -->
                
                <input type="hidden" name="calon_siswa_id" value="{{ Auth::user()->id }}">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Data Rinci Calon Siswa</h5>
                                <div class="form-group mb-3 d-flex justify-content-between">
                                    <div class="me-2">
                                        <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" min="1" value="{{ old('tinggi_badan', $dataRinci->tinggi_badan) }}" required>
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="berat_badan" name="berat_badan" min="1" value="{{ old('berat_badan', $dataRinci->berat_badan) }}" required>
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="anak_ke" class="form-label">Anak Ke-</label>
                                    <input type="number" class="form-control" id="anak_ke" name="anak_ke" min="1" value="{{ old('anak_ke', $dataRinci->anak_ke) }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jumlah_saudara" class="form-label">Jumlah Saudara</label>
                                    <input type="number" class="form-control" id="jumlah_saudara" name="jumlah_saudara" min="0" value="{{ old('jumlah_saudara', $dataRinci->jumlah_saudara) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Data Rinci Asal Sekolah</h5>
                                <div class="form-group mb-3">
                                    <label for="asal_sekolah" class="form-label">Nama Sekolah</label>
                                    <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah', $dataRinci->asal_sekolah) }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="alamat_sekolah_asal" class="form-label">Alamat Sekolah</label>
                                    <textarea class="form-control" id="alamat_sekolah_asal" name="alamat_sekolah_asal" rows="3" required>{{ old('alamat_sekolah_asal', $dataRinci->alamat_sekolah_asal) }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                                    <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" min="1000" max="{{ date('Y') }}" value="{{ old('tahun_lulus', $dataRinci->tahun_lulus) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
