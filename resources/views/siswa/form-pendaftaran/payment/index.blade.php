@extends('siswa.layouts.siswa-layout')

@section('title', 'Pembayaran Formulir')

@section('content')
<div class="pagetitle">
    <h1>Pembayaran Formulir</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pembayaran</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-title mb-3">Status Pembayaran</h4>

            @if (isset($payment))
                <div class="alert alert-success" role="alert">
                    <strong>{{ $status }}</strong>
                </div>
                <p><strong>ID Transaksi:</strong> {{ $payment->order_id }}</p>
                <p><strong>Jumlah:</strong> Rp{{ number_format($payment->gross_amount, 0, ',', '.') }}</p>
                <p>Terima kasih telah melakukan pembayaran. Kami akan memprosesnya secepat mungkin.</p>
            @else
                <div class="alert alert-warning" role="alert">
                    <strong>{{ $status }}</strong>
                </div>
                <p>Belum ada transaksi pembayaran yang tercatat.</p>
                <p>Silakan klik tombol di bawah ini untuk memulai proses pembayaran.</p>
                <a href="{{ route('payments.paymentPage') }}" class="btn btn-primary">Bayar Sekarang</a>
            @endif
        </div>
    </div>
</section>
@endsection
