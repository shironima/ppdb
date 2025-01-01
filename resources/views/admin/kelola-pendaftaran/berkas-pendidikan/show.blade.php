@extends('admin.layouts.admin-layout')

@section('title', 'Detail Berkas Pendidikan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <!-- Informasi Detail Berkas Pendidikan -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="m-0 font-weight-bold text-primary">Informasi Berkas Pendidikan</h5>
                </div>
                <div class="card-body">
                    @php
                        $statusOptions = [
                            'Verified' => 'Verified',
                            'In Progress' => 'In Progress',
                            'Requires Revision' => 'Requires Revision',
                            'Submitted' => 'Submitted',
                            'Updated' => 'Updated',
                            'Belum Diisi' => 'Belum Diisi'
                        ];
                    @endphp

                    <!-- Tab Navigasi -->
                    <ul class="nav nav-pills mb-3" id="infoBerkasTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="berkasPendidikanTab" data-bs-toggle="pill" href="#berkasPendidikan" role="tab">Berkas Pendidikan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="komentarTab" data-bs-toggle="pill" href="#komentar" role="tab">Komentar</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="infoBerkasTabContent">
                        <!-- Berkas Pendidikan -->
                        <div class="tab-pane fade show active" id="berkasPendidikan" role="tabpanel">
                            <h6>Berkas Pendidikan</h6>
                            <table class="table table-bordered">
                                <tr><th>Dokumen Ijazah</th>
                                    <td>
                                        @if($berkasPendidikan->ijazahUrl)
                                            <a href="{{ asset($berkasPendidikan->ijazahUrl) }}" target="_blank">Lihat Ijazah</a>
                                        @else
                                            <span class="text-muted">Belum diunggah</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr><th>Dokumen SKHUN</th>
                                    <td>
                                        @if($berkasPendidikan->skhunUrl)
                                            <a href="{{ asset($berkasPendidikan->skhunUrl) }}" target="_blank">Lihat SKHUN</a>
                                        @else
                                            <span class="text-muted">Belum diunggah</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr><th>Dokumen Raport</th>
                                    <td>
                                        @if($berkasPendidikan->raportUrl)
                                            <a href="{{ asset($berkasPendidikan->raportUrl) }}" target="_blank">Lihat Raport</a>
                                        @else
                                            <span class="text-muted">Belum diunggah</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr><th>Dokumen Kartu Keluarga</th>
                                    <td>
                                        @if($berkasPendidikan->kartu_keluargaUrl)
                                            <a href="{{ asset($berkasPendidikan->kartu_keluargaUrl) }}" target="_blank">Lihat Kartu Keluarga</a>
                                        @else
                                            <span class="text-muted">Belum diunggah</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <!-- Form untuk Update Status -->
                            <form action="{{ route('admin.verifikasi-berkas-pendidikan.updateStatus', $registration->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status Berkas Pendidikan</label>
                                    <select class="form-control" name="status" id="status">
                                        @foreach($statusOptions as $value => $label)
                                            <option value="{{ $value }}" {{ $berkasPendidikan->status == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Status</button>
                            </form>
                        </div>

                        <!-- Komentar -->
                        <div class="tab-pane fade" id="komentar" role="tabpanel">
                            <h6 class="mb-4">Tambahkan Komentar jika perlu memberikan catatan untuk Berkas Pendidikan</h6>
                            <form action="{{ route('admin.verifikasi-berkas-pendidikan.updateComment', $registration->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="komentar" class="form-label">Komentar</label>
                                    <textarea class="form-control" id="komentar" name="komentar" rows="4" placeholder="Masukkan komentar Anda di sini...">{{ old('komentar', $berkasPendidikan->komentar) }}</textarea>
                                    @error('komentar')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Komentar</button>
                            </form>

                            <hr class="my-4">

                            <!-- Menampilkan Komentar -->
                            <h6 class="mb-3">Komentar Saat Ini</h6>
                            <div class="border p-3 rounded" style="background-color: #f9f9f9;">
                                @if($berkasPendidikan->komentar)
                                    <p class="mb-0">{{ $berkasPendidikan->komentar }}</p>
                                @else
                                    <p class="text-muted mb-0">Belum ada komentar.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                // Callback setelah SweetAlert ditutup
                willClose: () => {
                    // Simpan posisi scroll sebelum SweetAlert
                    const currentScrollPosition = window.scrollY;

                    // Scroll kembali ke posisi yang sebelumnya
                    window.scrollTo(0, currentScrollPosition);
                }
            });
        });
    </script>
@endif

@endpush