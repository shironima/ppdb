<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Alamat;
use App\Models\CalonSiswa;

class AlamatController extends Controller
{
    public function index()
    {
        $calonSiswa = auth()->user()->calonSiswa;

        if (!$calonSiswa) {
            return redirect()->route('calon-siswa.create')->with('warning', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        $alamatCalonSiswa = auth()->user()->calonSiswa->alamat()->get();
        
        return view('siswa.form-pendaftaran.alamat.index', compact('alamatCalonSiswa'));
    }

    // Menampilkan halaman untuk mengisi formulir Alamat
    public function create()
    {
        return view('siswa.form-pendaftaran.alamat.create');
    }

    public function edit($id)
    {
        // Mendapatkan calon siswa yang sedang login
        $calonSiswa = auth()->user()->calonSiswa;

        if (!$calonSiswa) {
            return redirect()->route('data-diri.create')->with('warning', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        $alamat = $calonSiswa->alamat->find($id);

        // Memastikan hanya data calon siswa milik user yang sedang login yang bisa diubah
        if ($alamat->user_id !== Auth::id()) {
            return redirect()->route('calon-siswa.index')->with('error', 'Anda tidak memiliki akses untuk mengedit data ini.');
        }

        return view('siswa.form-pendaftaran.alamat.edit', compact('alamat'));
    }

    public function update(Request $request, $id)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'alamat_lengkap' => 'required|string|max:255',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kota_kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'required|string|digits:5',
            'tinggal_dengan' => 'required|in:orang_tua,wali-famili,panti-asrama',
        ]);

        // Mencari alamat berdasarkan ID
        $alamat = Alamat::findOrFail($id);

        // Memastikan alamat milik calon siswa yang sedang login
        if ($alamat->calon_siswa_id !== auth()->user()->calonSiswa->id) {
            return redirect()->route('alamat.index')->with('warning', 'Data alamat ini tidak ditemukan.');
        }

        // Update alamat dengan data yang telah divalidasi
        $alamat->update($validatedData);

        // Perbarui status menjadi "updated"
        $alamat->status = 'Updated';
        $alamat->save();

        // Redirect ke halaman alamat dengan pesan sukses
        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil diperbarui !');
    }

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
            'tinggal_dengan' => 'required|in:orang_tua,wali-famili,panti-asrama,lainnya',
        ]);

        // Periksa apakah data diri sudah diisi
        $calonSiswa = CalonSiswa::where('user_id', auth()->id())->first();

        if (!$calonSiswa) {
            return redirect()->route('data-diri.create')->with('warning', 'Silakan isi form data diri terlebih dahulu!');
        }

        // Ambil user_id dari autentikasi
        $validatedData = $request->only([
            'alamat_lengkap',
            'rt',
            'rw',
            'kelurahan',
            'kecamatan',
            'kota_kabupaten',
            'provinsi',
            'kode_pos',
            'tinggal_dengan',
        ]);

        // Set `user_id` dan `calon_siswa_id` yang terkait dengan pengguna yang sedang login
        $validatedData['user_id'] = auth()->id();
        $validatedData['calon_siswa_id'] = $calonSiswa->id;

        // Simpan data alamat terkait dengan calon siswa
        Alamat::create($validatedData);

        // Redirect ke halaman alamat dengan pesan sukses
        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil disimpan!');
    }
}
