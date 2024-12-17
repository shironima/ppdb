@extends('admin.layouts.admin-layout')

@section('title', 'Pertanyaan Menunggu Jawaban')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Pertanyaan Menunggu Jawaban</h1>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Menunggu Jawaban</h6>
                </div>
                <div class="card-body">
                    @if($isEmpty)
                        <p>Belum ada pertanyaan yang menunggu jawaban.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="jawabanTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Terakhir Update</th>
                                        <th>User</th>
                                        <th>Pertanyaan</th>
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
                                            <td>
                                                <button type="button" class="btn btn-warning mt-2" onclick="showAnswerModal({{ $pertanyaan->id }}, '{{ addslashes($pertanyaan->pertanyaan) }}')">
                                                    Jawab
                                                </button>
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

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
