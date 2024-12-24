<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationContact;

class NotificationContactController extends Controller
{
    public function index()
    {
        $notificationContacts = NotificationContact::all();
        return view('siswa.notification.index', compact('notificationContacts'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'email' => 'required|email', 
            'whatsapp' => 'required|string|regex:/^[0-9]+$/|max:15', 
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Pastikan ada relasi calon_siswa yang terkait dengan user
        $calonSiswa = $user->calonSiswa;

        if (!$calonSiswa) {
            return redirect()->back()->with('error', 'Data calon siswa tidak ditemukan.');
        }

        // Simpan data kontak notifikasi
        $notificationContact = new NotificationContact();
        $notificationContact->user_id = $user->id;
        $notificationContact->calon_siswa_id = $calonSiswa->id;
        $notificationContact->email = $validated['email']; 
        $notificationContact->whatsapp = $validated['whatsapp']; 
        $notificationContact->save();

        // Kembalikan response dengan pesan sukses
        return redirect()->back()->with('success', 'Kontak notifikasi berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => 'nullable|email',
            'whatsapp' => 'required|string|regex:/^[0-9]+$/|max:15',
        ]);

        // Temukan data notifikasi berdasarkan ID
        $notificationContact = NotificationContact::findOrFail($id);

        // Perbarui data kontak notifikasi
        $notificationContact->email = $validated['email'];
        $notificationContact->whatsapp = $validated['whatsapp'];
        $notificationContact->save();

        // Kembalikan response
        return redirect()->back()->with('success', 'Kontak notifikasi berhasil diperbarui!');
    }

    // Menghapus kontak notifikasi
    public function destroy($id)
    {
        $notificationContact = NotificationContact::findOrFail($id);
        $notificationContact->delete();

        return redirect()->back()->with('success', 'Kontak notifikasi berhasil dihapus!');
    }
}
