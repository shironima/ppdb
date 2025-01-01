<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Contact;
use App\Models\Registration;
use App\Enums\EnumVerifyRegistration;


class AdminVerifikasiPendaftaranController extends Controller
{
    public function index(Request $request)
    {
        // Ambil status filter dari request jika ada
        $status = $request->get('status');

        // Ambil data pendaftar dengan filter status jika ada
        $query = Registration::with([
            'calonSiswa', 
            'dataOrangTua', 
            'dataRinci', 
            'alamat'
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
                        'komentar' => $item->komentar ?? 'Belum ada komentar.'
                    ];
                })
            ]);
        }

        // Jika bukan AJAX request, tampilkan halaman view biasa
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

    public function destroy($id)
    {
        // Mencari pendaftar berdasarkan ID
        $pendaftar = Registration::findOrFail($id);

        // Menghapus data pendaftar
        $pendaftar->delete();

        // Mengembalikan response JSON agar dapat diproses oleh SweetAlert
        return response()->json(['message' => 'Pendaftar berhasil dihapus.']);
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
        return redirect()->back()->with('success', 'Status berhasil diperbarui untuk registrasi ' . $pendaftar->calonSiswa->nama_lengkap);
    }

    public function updateComment(Request $request, $type, $id)
    {
        // Validasi komentar
        $request->validate([
            'komentar' => 'nullable|string|max:1000',
        ]);

        // Temukan pendaftar berdasarkan ID
        $pendaftar = Registration::with([
            'calonSiswa',
            'alamat',
            'dataOrangTua',
            'dataRinci'
        ])->findOrFail($id);

        // Proses update komentar berdasarkan tipe
        switch ($type) {
            case 'calon_siswa':
                // Update komentar di tabel calon_siswa
                $pendaftar->calonSiswa->komentar = $request->komentar;
                $pendaftar->calonSiswa->save();
                break;
            case 'alamat':
                // Update komentar di tabel alamat
                $pendaftar->alamat->komentar = $request->komentar;
                $pendaftar->alamat->save();
                break;
            case 'data_orang_tua':
                // Update komentar di tabel data_orang_tua
                $pendaftar->dataOrangTua->komentar = $request->komentar;
                $pendaftar->dataOrangTua->save();
                break;
            case 'data_rinci':
                // Update komentar di tabel data_rinci
                $pendaftar->dataRinci->komentar = $request->komentar;
                $pendaftar->dataRinci->save();
                break;
            default:
                return redirect()->back()->with('error', 'Jenis data tidak valid.');
        }

        return redirect()->back()->with('success', 'Komentar berhasil diperbarui.');
    }


}
