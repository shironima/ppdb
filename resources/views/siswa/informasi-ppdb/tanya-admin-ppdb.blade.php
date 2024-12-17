@extends('siswa.layouts.siswa-layout')

@section('title', 'Tanya Admin PPDB')

@section('content')
<div class="pagetitle">
    <h1>Tanya Admin PPDB</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Tanya Admin PPDB</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ajukan Pertanyaan</h5>

                    <!-- Form Pengajuan Pertanyaan Baru -->
                    <form action="{{ route('siswa.informasi-ppdb.tanya-admin-ppdb.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="pertanyaan" class="form-label">Silahkan tulis pertanyaan Anda</label>
                            <textarea class="form-control @error('pertanyaan') is-invalid @enderror" id="pertanyaan" name="pertanyaan" rows="3" required></textarea>
                            @error('pertanyaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Pertanyaan</h5>

                    @if($isEmpty)
                        <p class="text-muted">Belum ada pertanyaan yang diajukan.</p>
                    @else
                        <table class="table datatable" id="pertanyaanTable">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal Diajukan</th>
                                    <th scope="col">Terakhir Diperbarui</th>
                                    <th scope="col">Pertanyaan</th>
                                    <th scope="col">Jawaban</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pertanyaans as $pertanyaan)
                                    <tr>
                                        <td>{{ $pertanyaan->created_at->format('d M Y, H:i') }}</td>
                                        <td>{{ $pertanyaan->updated_at->format('d M Y, H:i') }}</td>
                                        <td>{{ $pertanyaan->pertanyaan }}</td>
                                        <td>{{ $pertanyaan->jawaban ?? 'Belum dijawab' }}</td>
                                        <td>
                                            @if($pertanyaan->status == 'terjawab')
                                                <span class="badge bg-success">Dijawab</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Belum dijawab</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#pertanyaanTable').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data yang cocok",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data",
                "infoFiltered": "(disaring dari _MAX_ data total)",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>
@endpush
@endsection
