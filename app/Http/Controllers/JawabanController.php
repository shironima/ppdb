<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use Auth;

class JawabanController extends Controller
{
    public function index()
    {
        $pertanyaans = Pertanyaan::with('user')
                                ->where('status', 'menunggu jawaban')
                                ->orWhere('status', 'terjawab')
                                ->get();
        $isEmpty = $pertanyaans->isEmpty();

        return view('admin.hubungi-admin.index', compact('pertanyaans', 'isEmpty'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'jawaban' => 'required|string',
        ]);
    
        $pertanyaan = Pertanyaan::findOrFail($id);
        $pertanyaan->jawaban = $validated['jawaban'];
        $pertanyaan->status = 'terjawab';
        $pertanyaan->save();

        return response()->json(['message' => 'Jawaban berhasil disimpan.']);
    }

    public function menungguJawaban()
    {
        $pertanyaans = Pertanyaan::where('status', 'menunggu jawaban')->get();
        $isEmpty = $pertanyaans->isEmpty();

        return view('admin.hubungi-admin.not-answer', compact('pertanyaans', 'isEmpty'));
    }
}
