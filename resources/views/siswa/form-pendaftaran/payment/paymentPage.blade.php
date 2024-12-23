@extends('siswa.layouts.siswa-layout')

@section('title', 'Halaman Pembayaran')

@section('content')
<div class="pagetitle">
    <h1>Halaman Pembayaran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('payments.index') }}">Pembayaran</a></li>
            <li class="breadcrumb-item active">Bayar Sekarang</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Proses Pembayaran</h5>
                    <p>Silakan selesaikan pembayaran Anda dengan klik tombol di bawah ini:</p>

                    <!-- Menampilkan Informasi Pembayaran -->
                    <div class="mb-3">
                        <strong>Jumlah Pembayaran:</strong> Rp {{ number_format(150000, 0, ',', '.') }}
                    </div>

                    <!-- Cek status pembayaran -->
                    @if($status == 'Silakan lakukan pembayaran')
                        <!-- Tombol Bayar jika Snap Token tersedia -->
                        @if(isset($snapToken) && !empty($snapToken))
                            <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
                        @else
                            <p class="text-danger">Snap Token tidak ditemukan. Harap coba lagi.</p>
                        @endif
                    @else
                        <p>{{ $status }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Menambahkan Snap.js dari Midtrans -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script type="text/javascript">
    @if(isset($snapToken) && !empty($snapToken))
        // Mengikat event klik pada tombol bayar
        document.getElementById('pay-button').addEventListener('click', function () {
            // Menampilkan spinner loading
            var btn = document.getElementById('pay-button');
            btn.innerHTML = 'Memproses...';
            btn.disabled = true;

            // Memanggil fungsi pembayaran Midtrans Snap
            window.snap.pay("{{ $snapToken }}", {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil! ID Transaksi: " + result.order_id);
                    window.location.href = "{{ route('payments.index') }}";
                },
                onPending: function(result) {
                    alert("Pembayaran berhasil, menunggu konfirmasi admin.");
                    window.location.href = "{{ route('payments.index') }}";
                },
                onError: function(result) {
                    alert("Pembayaran gagal! Silakan coba lagi.");
                    btn.innerHTML = 'Bayar Sekarang';
                    btn.disabled = false;
                },
                onClose: function() {
                    alert("Anda menutup pembayaran. Tidak ada transaksi yang diproses.");
                    btn.innerHTML = 'Bayar Sekarang';
                    btn.disabled = false;
                }
            });
        });
    @else
        // Jika Snap Token tidak ditemukan
        document.getElementById('pay-button').addEventListener('click', function () {
            alert("Snap Token tidak ditemukan. Harap coba lagi.");
        });
    @endif
</script>
@endsection
