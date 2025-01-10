<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Registration;
use App\Models\BerkasPendidikan;
use App\Enums\EnumPendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminVerifikasiBerkasPendidikanController extends Controller
{
    /**
     * Menampilkan daftar berkas pendidikan yang diupload.
     */
    public function index(Request $request)
    {
        // Ambil status filter dari request jika ada
        $status = $request->get('status');

        // Ambil data pendaftar dengan filter status jika ada
        $query = Registration::with(['berkasPendidikan', 'calonSiswa'])
            ->when($status, function($query) use ($status) {
                return $query->whereHas('berkasPendidikan', function($q) use ($status) {
                    $q->where('status', $status);
                });
            });

        // Ambil total records tanpa filter
        $totalRecords = $query->count();

        // Ambil data pendaftar dengan filter status jika ada
        $pendaftar = $query->get();

        // Jika request menggunakan AJAX, kembalikan data dalam format JSON yang sesuai untuk DataTables
        if ($request->ajax()) {
            return response()->json([
                'draw' => $request->get('draw'),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,  // Menggunakan total tanpa filter
                'data' => $pendaftar->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nama_lengkap' => $item->calonSiswa->nama_lengkap ?? '-',
                        'status' => ucfirst($item->berkasPendidikan->status),
                        'created_at' => $item->berkasPendidikan->created_at->format('d M Y, H:i'),
                        'komentar' => $item->berkasPendidikan->komentar ?? 'Belum ada komentar.'
                    ];
                })
            ]);
        }

        // Jika bukan AJAX request, tampilkan halaman view biasa
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

        // Penyimpanan Lokal
        $berkasPendidikan->ijazahUrl = $berkasPendidikan->ijazah ? Storage::disk('public')->url($berkasPendidikan->ijazah) : null;
        $berkasPendidikan->skhunUrl = $berkasPendidikan->skhun ? Storage::disk('public')->url($berkasPendidikan->skhun) : null;
        $berkasPendidikan->raportUrl = $berkasPendidikan->raport ? Storage::disk('public')->url($berkasPendidikan->raport) : null;
        $berkasPendidikan->kartu_keluargaUrl = $berkasPendidikan->kartu_keluarga ? Storage::disk('public')->url($berkasPendidikan->kartu_keluarga) : null;


        // Kirim data berkasPendidikan dan registration ke view
        return view('admin.kelola-pendaftaran.berkas-pendidikan.show', compact('berkasPendidikan', 'registration'));
    }

    /**
     * Menampilkan daftar berkas pendidikan yang perlu diverifikasi.
     */
    public function needVerify()
    {
        // Ambil data dengan status 'Submitted' dan 'Updated' pada berkas pendidikan
        $pendaftar = Registration::with([
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
        // Temukan registration berdasarkan ID
        $registration = Registration::with('calonSiswa','berkasPendidikan')->findOrFail($id);

        // Ambil berkas pendidikan yang terkait dengan registration
        $berkasPendidikan = $registration->berkasPendidikan;

        // Pastikan berkas pendidikan ditemukan
        if (!$berkasPendidikan) {
            return response()->json(['message' => 'Berkas pendidikan tidak ditemukan.'], 404);
        }

        // Hapus file dari penyimpanan lokal jika ada
        if (Storage::exists($berkasPendidikan->ijazah)) {
            Storage::delete($berkasPendidikan->ijazah);
        }
        if (Storage::exists($berkasPendidikan->skhun)) {
            Storage::delete($berkasPendidikan->skhun);
        }
        if (Storage::exists($berkasPendidikan->raport)) {
            Storage::delete($berkasPendidikan->raport);
        }
        if (Storage::exists($berkasPendidikan->kartu_keluarga)) {
            Storage::delete($berkasPendidikan->kartu_keluarga);
        }

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
        Log::info("Updating status for registration id: $id");

        // Ambil data registration
        $registration = Registration::with('calonSiswa', 'berkasPendidikan')->findOrFail($id);
        Log::info('Registration found: ', $registration->toArray());

        // Validasi status yang diperbolehkan
        $validStatuses = ['Submitted', 'In Progress', 'Requires Revision', 'Verified'];
        if (!in_array($request->status, $validStatuses)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        // Pastikan data berkasPendidikan ada
        if (!$registration->berkasPendidikan) {
            return redirect()->back()->with('error', 'Berkas pendidikan tidak ditemukan.');
        }

        // Update status berkasPendidikan
        $berkasPendidikan = $registration->berkasPendidikan;
        if ($berkasPendidikan->status !== $request->status) {
            $berkasPendidikan->update(['status' => $request->status]);
        }

        // Kirimkan flash message
        return redirect()->route('admin.verifikasi-berkas-pendidikan.show', $registration->id)
            ->with('success', 'Status berhasil diperbarui untuk registrasi ' . $registration->calonSiswa->nama_lengkap);
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

        // Temukan registrasi terkait
        $registration = Registration::findOrFail($id);
        $berkasPendidikan = $registration->berkasPendidikan;

        // Update komentar di berkas pendidikan
        $berkasPendidikan->komentar = $request->komentar;
        $berkasPendidikan->save();

        // Menampilkan SweetAlert setelah komentar berhasil diperbarui
        return redirect()->route('admin.verifikasi-berkas-pendidikan.show', $id)
            ->with('success', 'Komentar berhasil diperbarui untuk registrasi ' . $registration->calonSiswa->nama_lengkap);
    }
}
