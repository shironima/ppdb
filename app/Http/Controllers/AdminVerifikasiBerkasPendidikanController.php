<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Registration;
use App\Models\BerkasPendidikan;
use App\Enums\EnumPendaftaran;
use Illuminate\Support\Facades\Auth;

class AdminVerifikasiBerkasPendidikanController extends Controller
{
    /**
     * Menampilkan daftar berkas pendidikan yang diupload.
     */
    public function index()
    {
        // Ambil data pendaftar beserta berkas pendidikan, pembayaran, dan relasi lainnya
        $pendaftar = Registration::with([
            'calonSiswa',
            'berkasPendidikan',
        ])
        ->paginate(10);

        return view('admin.kelola-pendaftaran.berkas-pendidikan.index', compact('pendaftar'));
    }

    /**
     * Menampilkan detail berkas pendidikan untuk verifikasi.
     */
    public function show($id)
    {
        // Ambil data dari tabel berkas_pendidikan yang terhubung dengan registration
        $registration = Registration::with('berkasPendidikan')->findOrFail($id);

        // Ambil data berkas pendidikan
        $berkasPendidikan = $registration->berkasPendidikan;

        // Menyertakan URL file dari Google Drive jika ada
        $berkasPendidikan->ijazahUrl = $berkasPendidikan->getFileUrl('ijazah');
        $berkasPendidikan->skhunUrl = $berkasPendidikan->getFileUrl('skhun');
        $berkasPendidikan->raportUrl = $berkasPendidikan->getFileUrl('raport');
        $berkasPendidikan->kartu_keluargaUrl = $berkasPendidikan->getFileUrl('kartu_keluarga');

        return view('admin.kelola-pendaftaran.berkas-pendidikan.show', compact('berkasPendidikan'));
    }

    /**
     * Menampilkan daftar berkas pendidikan yang perlu diverifikasi.
     */
    public function needVerify()
    {
        // Ambil data dengan status 'Submitted' dan 'Updated' pada berkas pendidikan
        $pendaftar = Registration::with([
            'calonSiswa',
            'berkasPendidikan',
        ])
        ->whereHas('berkasPendidikan', function ($query) {
            $query->whereIn('status', [
                EnumPendaftaran::Submitted->value,
                EnumPendaftaran::Updated->value,
            ]);
        })
        ->paginate(10);

        // Kirim data ke view
        return view('admin.kelola-pendaftaran.berkas-pendidikan.verifikasi', compact('pendaftar'));
    }

    /**
     * Menghapus berkas pendidikan yang terkait dengan pendaftar.
     */
    public function destroy($id)
    {
        // Temukan berkas pendidikan berdasarkan ID
        $berkasPendidikan = BerkasPendidikan::findOrFail($id);
        
        // Hapus file dari penyimpanan (Google Drive)
        Storage::disk('google')->delete($berkasPendidikan->ijazahUrl);
        Storage::disk('google')->delete($berkasPendidikan->skhunUrl);
        Storage::disk('google')->delete($berkasPendidikan->raportUrl);
        Storage::disk('google')->delete($berkasPendidikan->kartu_keluargaUrl);

        // Hapus data berkas pendidikan dari database
        $berkasPendidikan->delete();

        // Kembalikan respons JSON
        return response()->json(['message' => 'Berkas pendidikan berhasil dihapus.']);
    }

    /**
     * Mengupdate status berkas pendidikan terkait pendaftar.
     */
    public function updateStatus(Request $request, $id)
    {
        // Validasi status yang diterima
        $validStatuses = [
            EnumPendaftaran::Submitted->value,
            EnumPendaftaran::RequiresRevision->value,
            EnumPendaftaran::Updated->value,
            EnumPendaftaran::Verified->value,
            EnumPendaftaran::InProgress->value,
        ];

        if (!in_array($request->status, $validStatuses)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        // Temukan berkas pendidikan terkait pendaftar
        $pendaftar = Registration::with('berkasPendidikan')->findOrFail($id);
        $berkasPendidikan = $pendaftar->berkasPendidikan;

        // Update status berkas pendidikan
        if ($berkasPendidikan->status !== $request->status) {
            $berkasPendidikan->update(['status' => $request->status]);
        }

        return redirect()->route('admin.verifikasi-berkas-pendidikan.index')
            ->with('success', 'Status berkas pendidikan berhasil diperbarui.');
    }

    /**
     * Mengupdate komentar terkait berkas pendidikan.
     */
    public function updateComment(Request $request, $id)
    {
        // Validasi komentar
        $request->validate([
            'komentar' => 'nullable|string|max:1000',
        ]);

        // Temukan berkas pendidikan terkait pendaftar
        $pendaftar = Registration::findOrFail($id);
        $berkasPendidikan = $pendaftar->berkasPendidikan;

        // Update komentar di berkas pendidikan
        $berkasPendidikan->komentar = $request->komentar;
        $berkasPendidikan->save();

        // Redirect kembali ke halaman show dengan pesan sukses
        return redirect()->route('admin.verifikasi-berkas-pendidikan.show', $id)
            ->with('success', 'Komentar berhasil diperbarui');
    }
}
