<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\DataOrangTua;

class DataOrangTuaController extends Controller
{
    public function index()
    {
        $calonSiswa = auth()->user()->calonSiswa;

        if (!$calonSiswa) {
            return redirect()->route('data-diri.create')->with('warning', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        $dataOrangTua = auth()->user()->calonSiswa->dataOrangTua()->get(); // Pastikan untuk mengambil data orang tua yang terhubung dengan calon siswa

        return view('siswa.form-pendaftaran.data-orang-tua.index', compact('dataOrangTua'));
    }


    // Menampilkan halaman untuk mengisi formulir data orang tua
    public function create()
    {
        return view('siswa.form-pendaftaran.data-orang-tua.create');
    }

    // Menyimpan data orang tua
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'nama_ayah' => 'required|string|max:255',
            'nik_ayah' => 'required|string|max:255',
            'tahun_lahir_ayah' => 'required|integer',
            'pendidikan_ayah' => 'required|in:SD,SMP,SMA,Diploma,S-1,S-2,Lainnya',
            'pekerjaan_ayah' => 'required|in:ASN-TNI-POLRI,Guru-Dosen-Pengajar,Pengusaha,Pedagang,Wiraswasta,Wirausaha,Petani-Peternak,Lainnya',
            'penghasilan_ayah' => 'required|in:Dibawah 1jt,1jt-2jt,2jt-4jt,diatas 5jt',
            'nomor_hp_ayah' => 'required|string|regex:/^[0-9]+$/|max:15',
            'nama_ibu' => 'required|string|max:255',
            'nik_ibu' => 'required|string|max:255',
            'tahun_lahir_ibu' => 'required|integer',
            'pendidikan_ibu' => 'required|in:SD,SMP,SMA,Diploma,S-1,S-2,Lainnya',
            'pekerjaan_ibu' => 'required|in:ASN-TNI-POLRI,Guru-Dosen-Pengajar,Pengusaha,Pedagang,Wiraswasta,Wirausaha,Petani-Peternak,Lainnya',
            'penghasilan_ibu' => 'required|in:Dibawah 1jt,1jt-2jt,2jt-4jt,diatas 5jt',
            'nomor_hp_ibu' => 'required|string|regex:/^[0-9]+$/|max:15',
        ]);

        // Periksa apakah data calon siswa sudah diisi
        $calonSiswa = CalonSiswa::where('user_id', auth()->id())->first();

        if (!$calonSiswa) {
            return redirect()->route('data-diri.create')->with('warning', 'Silakan isi form data diri terlebih dahulu!');
        }

        // Ambil user_id dari autentikasi
        $validatedData = $request->only([
            'nama_ayah',
            'nik_ayah',
            'tahun_lahir_ayah',
            'pendidikan_ayah',
            'pekerjaan_ayah',
            'penghasilan_ayah',
            'nomor_hp_ayah',
            'nama_ibu',
            'nik_ibu',
            'tahun_lahir_ibu',
            'pendidikan_ibu',
            'pekerjaan_ibu',
            'penghasilan_ibu',
            'nomor_hp_ibu',
        ]);

        // Set `user_id` dan `calon_siswa_id` yang terkait dengan pengguna yang sedang login
        $validatedData['user_id'] = auth()->id();
        $validatedData['calon_siswa_id'] = $calonSiswa->id;

        // Simpan data orang tua terkait dengan calon siswa
        DataOrangTua::create($validatedData);

        // Redirect ke halaman data orang tua dengan pesan sukses
        return redirect()->route('data-orang-tua.index')->with('success', 'Data orang tua berhasil disimpan!');
    }

    // Menampilkan halaman edit
    public function edit()
    {
        $calonSiswa = auth()->user()->calonSiswa;

        if (!$calonSiswa) {
            return redirect()->route('data-diri.create')->with('warning', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        $dataOrangTua = $calonSiswa->dataOrangTua;

        return view('siswa.form-pendaftaran.data-orang-tua.edit', compact('dataOrangTua'));
    }

    // Memperbarui data orang tua
    public function update(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'nama_ayah' => 'required|string|max:255',
                'nik_ayah' => 'required|string|max:255',
                'tahun_lahir_ayah' => 'required|integer',
                'pendidikan_ayah' => 'required|in:SD,SMP,SMA,Diploma,S-1,S-2,Lainnya',
                'pekerjaan_ayah' => 'required|in:ASN-TNI-POLRI,Guru-Dosen-Pengajar,Pengusaha,Pedagang,Wiraswasta,Wirausaha,Petani-Peternak,Lainnya',
                'penghasilan_ayah' => 'required|in:Dibawah 1jt,1jt-2jt,2jt-4jt,diatas 5jt',
                'nomor_hp_ayah' => 'required|string|regex:/^[0-9]+$/|max:15',
                'nama_ibu' => 'required|string|max:255',
                'nik_ibu' => 'required|string|max:255',
                'tahun_lahir_ibu' => 'required|integer',
                'pendidikan_ibu' => 'required|in:SD,SMP,SMA,Diploma,S-1,S-2,Lainnya',
                'pekerjaan_ibu' => 'required|in:ASN-TNI-POLRI,Guru-Dosen-Pengajar,Pengusaha,Pedagang,Wiraswasta,Wirausaha,Petani-Peternak,Lainnya',
                'penghasilan_ibu' => 'required|in:Dibawah 1jt,1jt-2jt,2jt-4jt,diatas 5jt',
                'nomor_hp_ibu' => 'required|string|regex:/^[0-9]+$/|max:15',
            ]);

            // Periksa apakah calon siswa ada
            $calonSiswa = auth()->user()->calonSiswa;

            if (!$calonSiswa) {
                return redirect()->route('data-diri.create')->with('warning', 'Silakan lengkapi data diri terlebih dahulu.');
            }

            // Perbarui data
            $dataOrangTua = $calonSiswa->dataOrangTua;

            $dataOrangTua->update($validatedData);

            return redirect()->route('data-orang-tua.index')->with('success', 'Data orang tua berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
}
