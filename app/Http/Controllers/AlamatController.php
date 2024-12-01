<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Alamat; 

class AlamatController extends Controller
{
    // Menampilkan data alamat
    public function show()
    {
        // Mengambil data alamat calon siswa terkait dengan user yang sedang login
        $alamat = auth()->user()->calonSiswa->alamat;

        // Menampilkan view dengan data alamat
        return view('alamat.show', compact('alamat'));
    }

    // Form untuk mengedit data alamat calon siswa
    public function edit()
    {
        // Mengambil data alamat calon siswa
        $alamat = auth()->user()->calonSiswa->alamat;

        // Menampilkan form edit alamat
        return view('alamat.edit', compact('alamat'));
    }

    // Menyimpan atau memperbarui data alamat calon siswa
    public function update(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'alamat_lengkap' => 'required|string|max:255',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kota_kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'tinggal_dengan' => 'required|in:Orang tua,Wali/famili,Asrama/panti,Lainnya',
        ]);

        // Mengambil data alamat calon siswa
        $alamat = auth()->user()->calonSiswa->alamat;

        // Memperbarui data alamat
        $alamat->update([
            'alamat_lengkap' => $request->alamat_lengkap,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota_kabupaten' => $request->kota_kabupaten,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
            'tinggal_dengan' => $request->tinggal_dengan,
        ]);

        // Redirect ke halaman alamat dengan pesan sukses
        return redirect()->route('alamat.show')->with('success', 'Alamat berhasil diperbarui!');
    }

    // Menyimpan data alamat calon siswa (jika belum ada)
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'alamat_lengkap' => 'required|string|max:255',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kota_kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'tinggal_dengan' => 'required|in:Orang tua,Wali/famili,Asrama/panti,Lainnya',
        ]);

        // Simpan data alamat terkait dengan calon siswa
        auth()->user()->calonSiswa->alamat()->create([
            'alamat_lengkap' => $request->alamat_lengkap,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota_kabupaten' => $request->kota_kabupaten,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
            'tinggal_dengan' => $request->tinggal_dengan,
        ]);

        // Redirect ke halaman alamat dengan pesan sukses
        return redirect()->route('alamat.show')->with('success', 'Alamat berhasil disimpan!');
    }
}
