<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataRinci;
use App\Models\CalonSiswa;

class DataRinciController extends Controller
{
    public function index()
    {
        $calonSiswa = auth()->user()->calonSiswa;

        if (!$calonSiswa) {
            return redirect()->route('calon-siswa.create')->with('warning', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        $dataRinci = auth()->user()->calonSiswa->dataRinci()->get();

        return view('siswa.form-pendaftaran.data-rinci.index', compact('dataRinci'));  
    }

    public function create()
    {
        return view('siswa.form-pendaftaran.data-rinci.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'tinggi_badan' => 'required|integer|min:1',
            'berat_badan' => 'required|integer|min:1',
            'anak_ke' => 'required|integer|min:1',
            'jumlah_saudara' => 'required|integer|min:0',
            'asal_sekolah' => 'required|string|max:255',
            'tahun_lulus' => 'required|digits:4|integer',
            'alamat_sekolah_asal' => 'required|string|max:500',
        ]);

        // Periksa apakah data diri sudah diisi
        $calonSiswa = CalonSiswa::where('user_id', auth()->id())->first();

        if (!$calonSiswa) {
            return redirect()->route('data-diri.create')->with('warning', 'Silakan isi form data diri terlebih dahulu!');
        }

        // Ambil user_id dari autentikasi
        $validatedData['user_id'] = auth()->id();
        $validatedData['calon_siswa_id'] = $calonSiswa->id;

        // Simpan data rinci terkait dengan calon siswa
        DataRinci::create($validatedData);

        // Redirect ke halaman data rinci dengan pesan sukses
        return redirect()->route('data-rinci.index')->with('success', 'Data Rinci berhasil disimpan!');
    }

    public function edit($id)
    {
        // Mencari data rinci berdasarkan ID
        $dataRinci = DataRinci::findOrFail($id);

        // Memastikan data rinci milik calon siswa yang sedang login
        if ($dataRinci->calon_siswa_id !== auth()->user()->calonSiswa->id) {
            return redirect()->route('data-rinci.index')->with('warning', 'Data ini tidak ditemukan.');
        }

        // Menampilkan view form edit dengan data rinci yang sudah ada
        return view('siswa.form-pendaftaran.data-rinci.edit', compact('dataRinci'));
    }
    public function update(Request $request, $id)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'tinggi_badan' => 'required|integer|min:1',
            'berat_badan' => 'required|integer|min:1',
            'anak_ke' => 'required|integer|min:1',
            'jumlah_saudara' => 'required|integer|min:0',
            'asal_sekolah' => 'required|string|max:255',
            'tahun_lulus' => 'required|digits:4|integer',
            'alamat_sekolah_asal' => 'required|string|max:500',
        ]);

        // Mencari data rinci berdasarkan ID
        $dataRinci = DataRinci::findOrFail($id);

        // Memastikan data rinci milik calon siswa yang sedang login
        if ($dataRinci->calon_siswa_id !== auth()->user()->calonSiswa->id) {
            return redirect()->route('data-rinci.index')->with('warning', 'Data ini tidak ditemukan.');
        }

        // Update data rinci dengan data yang telah divalidasi
        $dataRinci->update($validatedData);

        // Perbarui status menjadi "updated"
        $dataRinci->status = 'Updated';
        $dataRinci->save();

        // Redirect ke halaman data rinci dengan pesan sukses
        return redirect()->route('data-rinci.index')->with('success', 'Data Rinci berhasil diperbarui !');
    }

}
