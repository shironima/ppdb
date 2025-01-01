<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\BerkasPendidikan;
use App\Helpers\GoogleDriveHelper;
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
            return redirect()->route('calon-siswa.create')
                ->with('warning', 'Silakan isi form data diri terlebih dahulu!');
        }

        // Sanitize nama_lengkap untuk dijadikan nama folder
        $folderName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $calonSiswa->nama_lengkap);

        // Path folder di Google Drive
        $baseFolder = 'ppdb';
        $googleFolderPath = $baseFolder . '/' . $folderName;

        // Pastikan folder sudah ada
        $googleDisk = Storage::disk('google');
        if (!$googleDisk->exists($googleFolderPath)) {
            $googleDisk->makeDirectory($googleFolderPath);
        }

        // Simpan file dengan path yang benar
        $files = [
            'ijazah' => 'ijazah.pdf',
            'skhun' => 'skhun.pdf',
            'raport' => 'raport.pdf',
            'kartu_keluarga' => 'kartu_keluarga.pdf',
        ];

        $berkas = new BerkasPendidikan();
        $berkas->user_id = auth()->id();
        $berkas->calon_siswa_id = $calonSiswa->id;

        foreach ($files as $field => $fileName) {
            if ($request->hasFile($field)) {
                $filePath = $request->file($field)->storeAs(
                    $googleFolderPath,
                    $fileName,
                    ['disk' => 'google']
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
        // Ambil data berkas pendidikan berdasarkan ID
        $berkasPendidikan = BerkasPendidikan::find($id);

        // Pastikan berkas pendidikan ditemukan, jika tidak, redirect dengan pesan error
        if (!$berkasPendidikan) {
            return redirect()->route('berkas-pendidikan.index')->with('error', 'Berkas pendidikan tidak ditemukan.');
        }

        return view('siswa.form-pendaftaran.berkas-pendidikan.edit', compact('berkasPendidikan'));
    }

    public function update(Request $request, $id){
        $berkas = BerkasPendidikan::find($id);
        $berkas->status = 'Updated';
        $berkas->save();

        return redirect()->route('berkas-pendidikan.index')
            ->with('success', 'Berkas pendidikan berhasil diperbarui.');
    }
}
