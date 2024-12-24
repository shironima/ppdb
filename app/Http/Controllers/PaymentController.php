<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // Fungsi untuk menampilkan halaman pembayaran
    public function index()
    {
        $user = Auth::user();
        $calonSiswa = $user->calonSiswa;

        if (!$calonSiswa) {
            return redirect()->route('calon-siswa.create')->with('warning', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        // Cek jika calon siswa sudah melakukan pembayaran sebelumnya
        $payment = Payment::where('calon_siswa_id', $calonSiswa->id)->first();

        if ($payment) {
            $status = 'Pembayaran sudah dilakukan.';
            return view('siswa.form-pendaftaran.payment.index', [
                'payment' => $payment,
                'status' => $status,
            ]);
        } else {
            // Status jika belum melakukan pembayaran
            $status = 'Silakan lakukan pembayaran';
            // Jika pembayaran tidak ditemukan, arahkan ke halaman pembayaran
            return view('siswa.form-pendaftaran.payment.index', [
                'status' => $status,
            ]);
        }
    }

    // Fungsi untuk memproses transaksi pembayaran
    public function paymentPage()
    {
        $calonSiswa = Auth::user()->calonSiswa;

        // Cek jika calon siswa belum melengkapi data diri
        if (!$calonSiswa) {
            return redirect()->route('calon-siswa.create')->with('warning', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        // Set konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Cek apakah sudah ada transaksi sebelumnya yang belum dibayar
        $payment = Payment::where('calon_siswa_id', $calonSiswa->id)
                        ->where('status', 'pending')
                        ->first();

        // Jika transaksi belum ada atau sudah dibayar, buat transaksi baru
        if (!$payment) {
            $payment = Payment::create([
                'calon_siswa_id' => $calonSiswa->id,
                'price' => 150000, // Harga formulir
                'transaction_status' => 'pending',
                'order_id' => 'order-' . Str::uuid(),
                'gross_amount' => 150000,
                'snap_token' => '',
            ]);
        }

        // Menentukan status pembayaran berdasarkan status transaksi
        $status = $payment->transaction_status == 'pending' ? 'Silakan lakukan pembayaran' : 'Pembayaran sudah dilakukan';

        // Parameter transaksi untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $payment->order_id,
                'gross_amount' => $payment->gross_amount,
            ],
            'customer_details' => [
                'first_name' => $calonSiswa->nama_lengkap,
                'email' => Auth::user()->email,
            ],
        ];

        try {
            // Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Simpan Snap Token di database
            $payment->snap_token = $snapToken;
            $payment->save();

            // Kirim Snap Token dan status ke view untuk diproses lebih lanjut
            return view('siswa.form-pendaftaran.payment.paymentPage', [
                'snapToken' => $snapToken,
                'orderId' => $payment->order_id,
                'status' => $status, // Kirim status pembayaran ke view
            ]);
        } catch (\Exception $e) {
            // Tangkap error dan log
            Log::error('Error while generating Snap Token', ['error_message' => $e->getMessage()]);
            return response()->json(['status' => 'failed', 'message' => 'Terjadi kesalahan saat membuat Snap Token'], 500);
        }
    }

    // Fungsi untuk menangani notifikasi pembayaran dari Midtrans
    public function notification(Request $request)
    {
        try {
            // Konfigurasi Midtrans
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false; // Ubah ke true jika di produksi
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Ambil data notifikasi dari Midtrans
            $notif = new Notification();

            // Log notifikasi yang diterima
            Log::info('Notification received from Midtrans', [
                'order_id' => $notif->order_id,
                'transaction_status' => $notif->transaction_status,
                'fraud_status' => $notif->fraud_status,
                'transaction_time' => $notif->transaction_time,
                'gross_amount' => $notif->gross_amount,
            ]);

            // Cari transaksi berdasarkan order_id
            $payment = Payment::where('order_id', $notif->order_id)->first();

            if (!$payment) {
                Log::warning('Payment not found', ['order_id' => $notif->order_id]);
                return response()->json(['status' => 'failed', 'message' => 'Payment not found'], 404);
            }

            // Tentukan status transaksi berdasarkan notifikasi dari Midtrans
            switch ($notif->transaction_status) {
                case 'capture':
                    $payment->transaction_status = ($notif->fraud_status === 'challenge') ? 'challenged' : 'success';
                    break;
                case 'settlement':
                    $payment->transaction_status = 'settled';
                    break;
                case 'pending':
                    // Ganti status pending dengan deskripsi baru
                    $payment->transaction_status = 'pembayaran diterima, menunggu konfirmasi admin';
                    break;
                case 'deny':
                    $payment->transaction_status = 'failed';
                    break;
                case 'expire':
                    $payment->transaction_status = 'expired';
                    break;
                case 'cancel':
                    $payment->transaction_status = 'cancelled';
                    break;
                default:
                    $payment->transaction_status = 'unknown';
                    break;
            }

            // Perbarui data transaksi di database
            $payment->transaction_time = $notif->transaction_time;
            $payment->gross_amount = $notif->gross_amount;

            // Pastikan data sudah terupdate dengan benar
            if ($payment->save()) {
                Log::info('Payment status updated successfully', [
                    'order_id' => $payment->order_id,
                    'transaction_status' => $payment->transaction_status,
                ]);
            } else {
                Log::error('Failed to update payment status', ['order_id' => $payment->order_id]);
            }

            // Kirimkan response sukses ke Midtrans
            return response()->json(['status' => 'success', 'message' => 'Payment status updated']);

        } catch (\Exception $e) {
            // Tangani error dan log
            Log::error('Error handling notification', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'failed', 'message' => 'Internal Server Error'], 500);
        }
    }
}
