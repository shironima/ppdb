<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CalonSiswaController extends Controller
{
    // Menampilkan data calon siswa yang terkait dengan user yang login
    public function index()
    {
        $calonSiswa = Auth::user()->calonSiswa()->get();

        if (!$calonSiswa) {
            return view('siswa.form-pendaftaran.data-diri.index', ['calonSiswa' => null]);
        }

        return view('siswa.form-pendaftaran.data-diri.index', compact('calonSiswa'));
    }

    // Form untuk mengedit data calon siswa
    public function edit()
    {
        $calonSiswa = auth()->user()->calonSiswa;
        return view('siswa.form-pendaftaran.data-diri.edit', compact('calonSiswa'));
    }

    // Update data calon siswa
    public function update(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'agama' => 'required|in:katholik,kristen,islam,hindu,budha,lainnya',
            'nisn' => 'required|string|unique:calon_siswa,nisn,' . auth()->user()->calonSiswa->id, 
            'no_kk' => 'required|string|max:100',
            'nik' => 'required|string|max:50',
            'no_hp' => 'required|string|regex:/^[0-9]+$/|max:15', // Validasi nomor HP dengan format yang benar
        ]);

        // Ambil data calon siswa terkait dengan user yang sedang login
        $calonSiswa = auth()->user()->calonSiswa;
        
        // Update data calon siswa
        $calonSiswa->update([
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'nisn' => $request->nisn,
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
        ]);

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('calon-siswa.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Form untuk membuat data calon siswa pertama kali (jika belum ada)
    public function create()
    {
        return view('siswa.form-pendaftaran.data-diri.create');
    }

    // Menyimpan data calon siswa yang baru
    public function store(Request $request)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'agama' => 'required|in:katholik,kristen,islam,hindu,budha,lainnya',
            'nisn' => 'required|string|unique:calon_siswa,nisn',
            'no_kk' => 'required|string|max:100',
            'nik' => 'required|string|max:50',
            'no_hp' => 'required|string|regex:/^[0-9]+$/|max:15',
        ]);

        // Tambahkan user_id ke data yang divalidasi
        $validatedData['user_id'] = auth()->id();

        // Simpan data ke database
        CalonSiswa::create($validatedData);

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('calon-siswa.index')->with('success', 'Data calon siswa berhasil disimpan!');
    }

    // Hapus data calon siswa yang terkait dengan user yang login
    public function destroy()
    {
        // Ambil data calon siswa yang terkait dengan user yang login
        $calonSiswa = auth()->user()->calonSiswa;

        // Hapus data calon siswa
        if ($calonSiswa) {
            $calonSiswa->delete();
            return redirect()->route('calon-siswa.create')->with('success', 'Data calon siswa berhasil dihapus!');
        }

        return redirect()->route('calon-siswa.create')->with('error', 'Data calon siswa tidak ditemukan!');
    }
}
