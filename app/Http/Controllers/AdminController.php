<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\AdminPPDB;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function indexEmail()
    {
        // Ambil data admin yang terkait dengan user yang sedang login
        $admin = AdminPPDB::where('user_id', auth()->id())->first();

        // Jika admin tidak ada, arahkan untuk membuat data
        if (!$admin) {
            return redirect()->route('admin.admin-contact.create')->with('warning', 'Anda belum memiliki data kontak notifikasi. Silakan buat data kontak notifikasi terlebih dahulu.');
        }

        // Jika data admin ada, tampilkan halaman pengelolaan email
        return view('admin.admin-ppdb.email.index', compact('admin'));
    }

    public function createEmail()
    {
        // Tampilkan form untuk membuat data admin (email)
        return view('admin.admin-ppdb.email.create');
    }

    public function storeEmail(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:admin_ppdb,email',
        ]);

        // Cari data admin berdasarkan ID user yang sedang login
        $admin = AdminPPDB::where('user_id', auth()->id())->first();

        // Jika admin belum ada, buat data baru
        if (!$admin) {
            $admin = new AdminPPDB();
            $admin->user_id = auth()->id();
        }

        // Simpan email di tabel admin_ppdb
        $admin->email = $request->email;
        $admin->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.admin-contact.email')->with('success', 'Email berhasil disimpan.');
    }

    public function updateEmail(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:admin_ppdb,email,' . auth()->id(),
        ]);

        // Cari data admin berdasarkan ID user yang sedang login
        $admin = AdminPPDB::where('user_id', auth()->id())->firstOrFail();

        // Update email di tabel admin_ppdb
        $admin->email = $request->email;
        $admin->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.admin-contact.email')->with('success', 'Email berhasil diperbarui.');
    }

    public function indexWhatsapp()
    {
        // Ambil data admin yang terkait dengan user yang sedang login
        $admin = AdminPPDB::where('user_id', auth()->id())->first();

        // Jika admin tidak ada, arahkan untuk membuat data
        if (!$admin) {
            return redirect()->route('admin.admin-contact.create')->with('warning', 'Anda belum memiliki data kontak notifikasi. Silakan data kontak notifikasi.');
        }

        // Jika data admin ada, tampilkan halaman pengelolaan email
        return view('admin.admin-ppdb.email.index', compact('admin'));
    }

    public function updateWhatsapp(Request $request)
    {
        // Validasi input
        $request->validate([
            'whatsapp' => 'nullable|string|max:20',
        ]);

        // Cari data admin berdasarkan ID user yang sedang login
        $admin = AdminPPDB::where('user_id', auth()->id())->firstOrFail();

        // Update nomor WhatsApp di tabel admin_ppdb
        $admin->whatsapp = $request->whatsapp;
        $admin->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.admin-contact.whatsapp')->with('success', 'Nomor WhatsApp berhasil diperbarui.');
    }


}
