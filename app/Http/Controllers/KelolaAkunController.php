<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KelolaAkunController extends Controller
{
    // Akun role: Admin
    public function indexAdmin()
    {
        $admins = User::where('role', 'admin')->get();

        return view('admin.kelola-akun.admin.index', compact('admins'));
    }

    public function createAkunAdmin()
    {
        return view('admin.kelola-akun.admin.create');
    }

    public function storeAkunAdmin(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
    
        try {
            // Simpan data admin baru
            $admin = new User();
            $admin->name = $validated['name'];
            $admin->email = $validated['email'];
            $admin->password = bcrypt($validated['password']);
            $admin->role = 'admin';
            $admin->save();
    
            return response()->json(['success' => true, 'message' => 'Akun berhasil ditambahkan.']);
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi
            return response()->json(['error' => 'Gagal menambahkan akun. ' . $e->getMessage()], 500);
        }
    }

    public function editAkunAdmin($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.kelola-akun.admin.edit', compact('admin'));
    }

    public function updateAkunAdmin(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        // Validasi data untuk update
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$id}",
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update data
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
        ]);

        return response()->json(['success' => 'Akun admin berhasil diperbarui.']);
    }

    public function destroyAkunAdmin($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return response()->json(['message' => 'Akun admin berhasil dihapus.']);
    }

    // Akun role: Siswa
    public function indexSiswa()
    {
        $siswas = User::where('role', 'siswa')->get();
        return view('admin.kelola-akun.calon-siswa.index', compact('siswas'));
    }

    public function createAkunSiswa()
    {
        return view('admin.kelola-akun.calon-siswa.create');
    }

    public function storeAkunSiswa(Request $request)
    {
        /// Validasi data input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
    
        try {
            // Simpan data admin baru
            $siswas = new User();
            $siswas->name = $validated['name'];
            $siswas->email = $validated['email'];
            $siswas->password = bcrypt($validated['password']);
            $siswas->role = 'siswa';
            $siswas->save();
    
            return response()->json(['success' => true, 'message' => 'Akun berhasil ditambahkan.']);
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi
            return response()->json(['error' => 'Gagal menambahkan akun. ' . $e->getMessage()], 500);
        }
    }

    public function editAkunSiswa($id)
    {
        $siswa = User::findOrFail($id);
        return view('admin.kelola-akun.calon-siswa.edit', compact('siswa'));
    }

    public function updateAkunSiswa(Request $request, $id)
    {
        $siswa = User::findOrFail($id);

        // Validasi data untuk update
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$id}",
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update data
        $siswa->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $siswa->password,
        ]);

        return response()->json(['success' => 'Akun siswa berhasil diperbarui.']);
    }

    public function destroyAkunSiswa($id)
    {
        try {
            Log::info('Menerima permintaan delete untuk ID: ' . $id);
    
            // Cari user dengan role siswa
            $siswa = User::where('role', 'siswa')->findOrFail($id);
            Log::info('Data siswa ditemukan: ' . json_encode($siswa));
    
            // Hapus data siswa (otomatis menghapus data terkait melalui event deleting)
            $siswa->delete();
    
            Log::info('Data siswa dan semua data terkait berhasil dihapus.');
            return response()->json(['success' => true, 'message' => 'Akun siswa dan data terkait berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus akun siswa: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal menghapus akun siswa. ' . $e->getMessage()], 500);
        }
    }
}
