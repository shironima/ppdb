<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\BerkasPendidikan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BerkasPendidikanController extends Controller
{
    public function index()
    {
        // Ambil data calon siswa yang sedang login
        $calonSiswa = Auth::user()->calonSiswa;

        if (!$calonSiswa) {
            return redirect()->route('calon-siswa.create')->with('warning', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        $berkasPendidikan = auth()->user()->calonSiswa->berkasPendidikan()->get();

        // Mengambil URL file dari Google Drive
        foreach ($berkasPendidikan as $berkas) {
            $berkas->ijazahUrl = $berkas->getFileUrl('ijazah');
            $berkas->skhunUrl = $berkas->getFileUrl('skhun');
            $berkas->raportUrl = $berkas->getFileUrl('raport');
            $berkas->kartu_keluargaUrl = $berkas->getFileUrl('kartu_keluarga');
        }

        return view('siswa.form-pendaftaran.berkas-pendidikan.index', compact('berkasPendidikan'));
    }

    public function create()
    {
        return view('siswa.form-pendaftaran.berkas-pendidikan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ijazah' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'skhun' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'raport' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'kartu_keluarga' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $calonSiswa = CalonSiswa::where('user_id', auth()->id())->first();

        if (!$calonSiswa) {
            return redirect()->route('calon-siswa.create')->with('warning', 'Silakan isi form data diri terlebih dahulu!');
        }

        $validatedData['user_id'] = auth()->id();
        $validatedData['calon_siswa_id'] = $calonSiswa->id;

        $berkas = new BerkasPendidikan($validatedData);

        // Upload ke Google Drive
        if ($request->hasFile('ijazah')) {
            $folderName = $calonSiswa->nama;
            $berkas->ijazah = $request->file('ijazah')->storeAs('ppdb/' . $folderName, 'ijazah.pdf', ['disk' => 'google']);
        }
        if ($request->hasFile('skhun')) {
            $folderName = $calonSiswa->nama;
            $berkas->skhun = $request->file('skhun')->storeAs('ppdb/' . $folderName, 'skhun.pdf', ['disk' => 'google']);
        }
        if ($request->hasFile('raport')) {
            $folderName = $calonSiswa->nama;
            $berkas->raport = $request->file('raport')->storeAs('ppdb/' . $folderName, 'raport.pdf', ['disk' => 'google']);
        }
        if ($request->hasFile('kartu_keluarga')) {
            $folderName = $calonSiswa->nama;
            $berkas->kartu_keluarga = $request->file('kartu_keluarga')->storeAs('ppdb/' . $folderName, 'kartu_keluarga.pdf', ['disk' => 'google']);
        }

        $berkas->status = 'Submitted';
        $berkas->save();

        return redirect()->route('berkas-pendidikan.index')->with('success', 'Berkas pendidikan berhasil diupload.');
    }

}
