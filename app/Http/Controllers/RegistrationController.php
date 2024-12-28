<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNotificationMail;
use App\Mail\SiswaNotificationMail;
use Illuminate\Support\Str;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function index()
    {
        // Ambil data calon siswa terkait dengan user yang login
        $calonSiswa = auth()->user()->calonSiswa;

        // Ambil data lengkap user dan relasi calon siswa
        $user = Auth::user()->load([
            'calonSiswa.alamat',
            'calonSiswa.dataOrangTua',
            'calonSiswa.dataRinci',
            'calonSiswa.berkasPendidikan',
            'calonSiswa.payments',
            'notificationContact',
        ]);

        // Tentukan status untuk setiap formulir
        $formulir = [
            $user->calonSiswa->status ?? null,
            $user->calonSiswa->alamat->status ?? null,
            $user->calonSiswa->dataOrangTua->status ?? null,
            $user->calonSiswa->dataRinci->status ?? null,
            $user->calonSiswa->berkasPendidikan->status ?? null,
            // Cek status pembayaran
            $user->calonSiswa->payments->where('transaction_status', 'settlement')->count() > 0 ? 'Submitted' : 'Belum Diisi',
        ];

        // Cek jika semua formulir sudah disubmit
        $allFormSubmitted = collect($formulir)->every(fn($status) => $status === 'Submitted');

        // Cek apakah notificationContact ada dan memiliki email dan whatsapp
        $isContactComplete = $user->notificationContact 
            && !empty($user->notificationContact->email) 
            && !empty($user->notificationContact->whatsapp);

        // Kirim data ke view
        return view('siswa.registration.index', compact('user', 'allFormSubmitted', 'isContactComplete', 'calonSiswa'));
    }

    public function submit()
    {
        $user = Auth::user()->load([
            'calonSiswa',
            'calonSiswa.alamat',
            'calonSiswa.dataOrangTua',
            'calonSiswa.dataRinci',
            'calonSiswa.berkasPendidikan',
            'calonSiswa.payments',
            'notificationContact',
        ]);

        $calonSiswa = $user->calonSiswa;

        // Validasi apakah semua data yang diperlukan telah diisi
        if (
            !$calonSiswa || 
            !$calonSiswa->alamat || 
            !$calonSiswa->dataOrangTua || 
            !$calonSiswa->dataRinci || 
            !$calonSiswa->berkasPendidikan
        ) {
            return back()->with('error', 'Pastikan semua formulir telah diisi dengan lengkap!');
        }

        // Cek apakah user sudah mengirim pendaftaran sebelumnya
        $existingRegistration = Registration::where('calon_siswa_id', $calonSiswa->id)->first();

        if ($existingRegistration) {
            return back()->with('already_submitted', 'Anda sudah mengirim pendaftaran sebelumnya.');
        }

        // Cek apakah calon siswa memiliki pembayaran yang terkait
        // Mengambil pembayaran pertama
        $payment = $calonSiswa->payments->first();

        if (!$payment || $payment->transaction_status !== 'settlement') {
            return back()->with('error', 'Pembayaran belum diterima atau belum selesai. Silakan selesaikan pembayaran terlebih dahulu.');
        }        

        try {
            // Buat entri baru di tabel registrations
            Registration::create([
                'id' => Str::uuid()->toString(),
                'calon_siswa_id' => $calonSiswa->id,
                'berkas_pendidikan_id' => $calonSiswa->berkasPendidikan->id,
                'payments_id' => $payment->id,
                'alamat_id' => $calonSiswa->alamat->id,
                'data_orang_tua_id' => $calonSiswa->dataOrangTua->id,
                'data_rinci_id' => $calonSiswa->dataRinci->id,
            ]);

            // Kirim notifikasi email
            $userEmail = $user->notificationContact->email ?? null;
            $adminEmail = 'gabrielahensky.dev@gmail.com';

            // Kirim email ke user (calon siswa) jika email tersedia
            if ($userEmail) {
                Mail::to($userEmail)->send(new SiswaNotificationMail($user));
            }

            // Kirim email ke admin
            Mail::to($adminEmail)->send(new AdminNotificationMail($user));

            // Redirect dengan pesan sukses
            return back()->with('success', 'Pendaftaran Anda telah berhasil dikirim dan notifikasi email telah dikirim!');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return back()->with('error', 'Terjadi kesalahan saat mengirim pendaftaran: ' . $e->getMessage());
        }
    }
}
