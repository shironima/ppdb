<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Enums\EnumVerifyRegistration;
use Illuminate\Support\Facades\Log;
use App\Events\RegistrationStatusChanged;
use Illuminate\Support\Facades\Auth;

class AdminPenerimaanCalonSiswaController extends Controller
{
    /**
     * Menampilkan daftar pendaftaran.
     */
    public function index(Request $request)
    {
        // Ambil status filter dari request jika ada
        $status = $request->get('status');

        // Ambil data pendaftar dengan filter status jika ada
        $query = Registration::with([
            'calonSiswa', 
            'dataOrangTua', 
            'dataRinci', 
            'alamat',
            'berkasPendidikan'
        ])
        ->when($status, function ($query) use ($status) {
            return $query->where('status', $status);
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
                        'asal_sekolah' => $item->dataRinci->asal_sekolah ?? '-',
                        'status' => ucfirst($item->status),
                        'created_at' => $item->created_at->format('d M Y, H:i'),
                        'komentar' => $item->komentar ?? 'Belum ada komentar.',
                    ];
                })
            ]);
        }

        // Jika bukan AJAX request, tampilkan halaman view biasa
        return view('admin.kelola-pendaftaran.penerimaan-calon-siswa.index', compact('pendaftar'));
    }

    /**
     * Menampilkan detail pendaftaran.
     */
    public function show($id)
    {
        $registration = Registration::with([
            'calonSiswa', 
            'alamat', 
            'dataOrangTua', 
            'dataRinci', 
            'berkasPendidikan'
        ])->findOrFail($id);

        return view('admin.kelola-pendaftaran.penerimaan-calon-siswa.show', compact('registration'));
    }

    /**
     * Memperbarui status dan komentar pada tabel registration.
     */

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:submitted,updated,verified,accepted',
            'komentar' => 'nullable|string|max:255',
        ]);
     
        // Cari pendaftar berdasarkan ID
        $registration = Registration::findOrFail($id);

        $registration = $registration->first();
     
        // Perbarui status dan komentar
        $registration->status = $request->status;
        $registration->komentar = $request->komentar;
        $updated = $registration->save();
     
        Log::info('Memicu event untuk pendaftaran ID: ' . $registration->id);
        // Memicu event setelah status diperbarui
        event(new RegistrationStatusChanged($registration));
     
        // Berikan respons berdasarkan hasil
        if ($updated) {
            return redirect()->route('verifikasi-pendaftaran.show', $id)
                ->with('success', 'Status dan komentar berhasil diperbarui.');
        } else {
            return redirect()->back()->withErrors('Gagal memperbarui data.');
        }
    }
       
    /**
     * Menghapus pendaftaran.
     */
    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return response()->json(['message' => 'Pendaftaran berhasil dihapus.']);
    }
}
