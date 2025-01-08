<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\BerkasPendidikan;
use App\Helpers\StorageHelper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class BerkasPendidikanController extends Controller
{
    public function index()
    {
        $calonSiswa = Auth::user()->calonSiswa;

        if (!$calonSiswa) {
            return redirect()->route('calon-siswa.create')->with('warning', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        $berkasPendidikan = $calonSiswa->berkasPendidikan()->get();

        // Mengambil URL file dari storage lokal
        foreach ($berkasPendidikan as $berkas) {
            // Menggunakan metode getFileUrl dari model untuk mendapatkan URL file
            $berkas->ijazahUrl = $berkas->ijazah ? $berkas->getFileUrl('ijazah') : null;
            $berkas->skhunUrl = $berkas->skhun ? $berkas->getFileUrl('skhun') : null;
            $berkas->raportUrl = $berkas->raport ? $berkas->getFileUrl('raport') : null;
            $berkas->kartu_keluargaUrl = $berkas->kartu_keluarga ? $berkas->getFileUrl('kartu_keluarga') : null;
        }

        return view('siswa.form-pendaftaran.berkas-pendidikan.index', compact('berkasPendidikan'));
    }

    public function create()
    {
        $calonSiswa = Auth::user()->calonSiswa;

        if (!$calonSiswa) {
            return redirect()->route('calon-siswa.create')->with('warning', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        return view('siswa.form-pendaftaran.berkas-pendidikan.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'ijazah' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'skhun' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'raport' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'kartu_keluarga' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Dapatkan calon siswa dari user login
        $calonSiswa = Auth::user()->calonSiswa;

        if (!$calonSiswa) {
            return redirect()->route('calon-siswa.create')->with('warning', 'Silakan isi form data diri terlebih dahulu!');
        }

        $folderName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $calonSiswa->nama_lengkap);

        $berkas = BerkasPendidikan::firstOrNew([
            'calon_siswa_id' => $calonSiswa->id
        ]);

        // Tambahkan user_id
        $berkas->user_id = Auth::id();

        // Simpan file menggunakan helper
        foreach (['ijazah', 'skhun', 'raport', 'kartu_keluarga'] as $field) {
            if ($request->hasFile($field)) {
                $filePath = StorageHelper::storeFile(
                    $request->file($field), 
                    "ppdb/$folderName", 
                    "$field." . $request->file($field)->getClientOriginalExtension()
                );
                $berkas->$field = $filePath;
            }
        }

        $berkas->status = 'Submitted';
        $berkas->save();

        return redirect()->route('berkas-pendidikan.index')
            ->with('success', 'Berkas pendidikan berhasil diupload.');
    }

    public function edit($id)
    {
        $berkasPendidikan = BerkasPendidikan::find($id);

        if (!$berkasPendidikan) {
            return redirect()->route('berkas-pendidikan.index')->with('error', 'Berkas pendidikan tidak ditemukan.');
        }

        return view('siswa.form-pendaftaran.berkas-pendidikan.edit', compact('berkasPendidikan'));
    }

    public function update(Request $request, $id)
    {
        $berkas = BerkasPendidikan::find($id);

        if (!$berkas) {
            return redirect()->route('berkas-pendidikan.index')
                ->with('error', 'Berkas pendidikan tidak ditemukan.');
        }

        // Perbarui status
        $berkas->status = 'Updated';

        // Update file jika ada yang baru diunggah
        foreach (['ijazah', 'skhun', 'raport', 'kartu_keluarga'] as $field) {
            if ($request->hasFile($field)) {
                $filePath = StorageHelper::storeFile($request->file($field), "ppdb/{$berkas->calonSiswa->nama_lengkap}", "$field." . $request->file($field)->getClientOriginalExtension());
                $berkas->$field = $filePath;
            }
        }

        $berkas->save();

        return redirect()->route('berkas-pendidikan.index')
            ->with('success', 'Berkas pendidikan berhasil diperbarui.');
    }
}
