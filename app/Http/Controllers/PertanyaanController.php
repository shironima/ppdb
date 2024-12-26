<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use App\Models\User;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the pertanyaan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil pertanyaan hanya untuk user yang sedang login
        $pertanyaans = Pertanyaan::with('user')
                                ->where('user_id', auth()->id())
                                ->get();

        // Tampilkan pesan jika belum ada pertanyaan
        $isEmpty = $pertanyaans->isEmpty();

        return view('siswa.informasi-ppdb.tanya-admin-ppdb', compact('pertanyaans', 'isEmpty'));
    }

    /**
     * Store a newly created pertanyaan in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
        ]);

        // Menyimpan pertanyaan dengan user yang sedang login
        Pertanyaan::create([
            'user_id' => auth()->id(),
            'pertanyaan' => $request->pertanyaan,
            'status' => 'menunggu jawaban',
        ]);

        return redirect()->route('siswa.informasi-ppdb.tanya-admin-ppdb')->with('success', 'Pertanyaan berhasil diajukan!');
    }
}
