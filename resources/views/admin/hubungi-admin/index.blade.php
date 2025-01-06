@extends('admin.layouts.admin-layout')

@section('title', 'Tanya Admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Semua Pertanyaan</h6>
                </div>
                <div class="card-body">
                    @if($isEmpty)
                        <p>Belum ada pertanyaan yang diajukan.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="jawabanTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Terakhir Update</th>
                                        <th>User</th>
                                        <th>Pertanyaan</th>
                                        <th>Jawaban</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pertanyaans as $pertanyaan)
                                        <tr>
                                            <td>{{ $pertanyaan->id }}</td>
                                            <td>{{ $pertanyaan->updated_at->format('d M Y, H:i') }}</td>
                                            <td>{{ $pertanyaan->user->name }}</td>
                                            <td>{{ $pertanyaan->pertanyaan }}</td>
                                            <td>{{ $pertanyaan->jawaban }}</td>
                                            <td>{{ $pertanyaan->status }}</td>
                                            <td>
                                                @if($pertanyaan->status === 'menunggu jawaban')
                                                <button type="button" class="btn btn-warning mt-2" onclick="showAnswerModal({{ $pertanyaan->id }}, '{{ addslashes($pertanyaan->pertanyaan) }}')">
                                                    Jawab
                                                </button>
                                                @else
                                                    <span class="text-muted">Terjawab</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function() {
        $('#jawabanTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/Indonesian.json"
            }
        });
    });

    // SweetAlert untuk menjawab pertanyaan
    function showAnswerModal(id, pertanyaan) {
        Swal.fire({
            title: 'Jawab Pertanyaan',
            html: `
                <p><strong>Pertanyaan:</strong> ${pertanyaan}</p>
                <textarea id="jawabanInput" class="form-control" placeholder="Tulis jawaban di sini"></textarea>
            `,
            showCancelButton: true,
            cancelButtonText: 'Batal',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan',
            confirmButtonColor: '#3085d6',
            preConfirm: () => {
                const jawaban = document.getElementById('jawabanInput').value;

                if (!jawaban) {
                    Swal.showValidationMessage('Jawaban tidak boleh kosong!');
                    return false;
                }

                return fetch(`{{ route('admin.hubungi-admin.store', '') }}/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ jawaban })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                })
                .catch(error => {
                    Swal.showValidationMessage(`Terjadi kesalahan: ${error}`);
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Berhasil!',
                    'Jawaban berhasil disimpan.',
                    'success'
                ).then(() => {
                    location.reload();
                });
            }
        });
    }
    </script>
@endpush

@endsection
