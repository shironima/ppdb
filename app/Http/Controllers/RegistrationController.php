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
use App\Events\RegistrationUpdated;
use App\Events\RegistrationSubmitted;


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
            'notificationContact',
        ]);

        // Tentukan status untuk setiap formulir
        $formulir = [
            $user->calonSiswa->status ?? null,
            $user->calonSiswa->alamat->status ?? null,
            $user->calonSiswa->dataOrangTua->status ?? null,
            $user->calonSiswa->dataRinci->status ?? null,
            $user->calonSiswa->berkasPendidikan->status ?? null,
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
        // Mengambil data user dan relasi calon siswa yang terkait
        $user = Auth::user()->load([
            'calonSiswa',
            'calonSiswa.alamat',
            'calonSiswa.dataOrangTua',
            'calonSiswa.dataRinci',
            'calonSiswa.berkasPendidikan',
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

        $registrationStatus = 'submitted';

        try {
            // Buat entri baru di tabel registrations dengan status "submitted"
            $registration = Registration::create([
                'id' => Str::uuid()->toString(),
                'calon_siswa_id' => $calonSiswa->id,
                'berkas_pendidikan_id' => $calonSiswa->berkasPendidikan->id,
                'alamat_id' => $calonSiswa->alamat->id,
                'data_orang_tua_id' => $calonSiswa->dataOrangTua->id,
                'data_rinci_id' => $calonSiswa->dataRinci->id,
                'notification_contact_id' => $user->notificationContact->id,
                'status' => $registrationStatus,
            ]);

        // Memicu event RegistrationSubmitted
        event(new RegistrationSubmitted($registration));

        return back()->with('success', 'Pendaftaran berhasil dikirim!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        // Ambil data calon siswa terkait dengan user yang login
        $calonSiswa = Auth::user()->calonSiswa;

        // Ambil pendaftaran terkait dengan calon siswa
        $registration = Registration::where('calon_siswa_id', $calonSiswa->id)->firstOrFail();

        // Update data hanya jika ada input yang diberikan
        if ($request->has('alamat')) {
            $registration->calonSiswa->alamat->update($request->input('alamat'));
        }

        if ($request->has('data_orang_tua')) {
            $registration->calonSiswa->dataOrangTua->update($request->input('data_orang_tua'));
        }

        if ($request->has('data_rinci')) {
            $registration->calonSiswa->dataRinci->update($request->input('data_rinci'));
        }

        if ($request->has('berkas_pendidikan')) {
            $registration->calonSiswa->berkasPendidikan->update($request->input('berkas_pendidikan'));
        }

        // Ubah status pendaftaran menjadi 'updated'
        $registration->status = 'Updated';
        $registration->save();

        // Memicu event RegistrationSubmitted
        event(new RegistrationUpdated($registration));

        return back()->with('success', 'Data berhasil diperbarui!');
    }

}
