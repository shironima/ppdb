<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Contact;
use App\Models\Registration;


class AdminVerifikasiPendaftaranController extends Controller
{
    public function index()
    {
        $pendaftar = Registration::with([
            'calonSiswa',
            'berkasPendidikan',
            'dataOrangTua',
            'dataRinci',
            'alamat',
            'pembayaran'
        ])
        ->paginate(10);

        return view('admin.kelola-pendaftaran.pendaftaran-siswa-baru.index', compact('pendaftar'));
    }

    /**
     * Menampilkan detail pendaftar untuk verifikasi.
     */
    public function show($id)
    {
        $pendaftar = Registration::with([
            'calonSiswa',
            'dataOrangTua',
            'dataRinci',
            'alamat'
        ])->findOrFail($id);

        return view('admin.kelola-pendaftaran.pendaftaran-siswa-baru.show', compact('pendaftar'));
    }

    /**
     * Melakukan verifikasi pendaftaran.
     */
    public function verify(Request $request, $id)
    {
        $pendaftar = Registration::findOrFail($id);

        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'catatan' => 'nullable|string|max:255',
        ]);

        $pendaftar->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->route('admin.kelola-pendaftaran.pendaftaran-siswa-baru.index')
            ->with('success', 'Verifikasi pendaftaran berhasil.');
    }

    public function destroy($id)
    {
        // Mencari pendaftar berdasarkan ID
        $pendaftar = Registration::findOrFail($id);

        // Menghapus data pendaftar
        $pendaftar->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.verifikasi-pendaftaran.index')->with('success', 'Pendaftar berhasil dihapus.');
    }

    public function updateStatus(Request $request, $type, $id)
    {
        $pendaftar = Registration::with([
            'calonSiswa',
            'alamat',
            'dataOrangTua',
            'dataRinci'
        ])->findOrFail($id);

        // Cek apakah status request valid
        $validStatuses = ['Submitted', 'In Progress', 'Requires Revision', 'Verified'];
        if (!in_array($request->status, $validStatuses)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        // Proses update status berdasarkan tipe
        switch ($type) {
            case 'calon_siswa':
                if ($pendaftar->calonSiswa->status !== $request->status) {
                    $pendaftar->calonSiswa->update(['status' => $request->status]);
                }
                break;
            case 'alamat':
                if ($pendaftar->alamat->status !== $request->status) {
                    $pendaftar->alamat->update(['status' => $request->status]);
                }
                break;
            case 'data_orang_tua':
                if ($pendaftar->dataOrangTua->status !== $request->status) {
                    $pendaftar->dataOrangTua->update(['status' => $request->status]);
                }
                break;
            case 'data_rinci':
                if ($pendaftar->dataRinci->status !== $request->status) {
                    $pendaftar->dataRinci->update(['status' => $request->status]);
                }
                break;
            default:
                return redirect()->back()->with('error', 'Jenis data tidak valid.');
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    public function updateComment(Request $request, $id)
    {
        // Validasi komentar
        $request->validate([
            'komentar' => 'nullable|string|max:1000',
        ]);

        // Temukan pendaftar berdasarkan ID
        $pendaftar = Registration::findOrFail($id);

        // Update komentar di tabel registration
        $pendaftar->komentar = $request->komentar;
        $pendaftar->save();

        // Redirect kembali ke halaman show dengan pesan sukses
        return redirect()->route('admin.verifikasi-pendaftaran.show', $id)->with('success', 'Komentar berhasil diperbarui');
    }


}
