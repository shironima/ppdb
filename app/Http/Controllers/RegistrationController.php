<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load([
            'calonSiswa.alamat',
            'calonSiswa.dataOrangTua',
            'calonSiswa.dataRinci',
            'calonSiswa.berkasPendidikan',
            'calonSiswa.payments',
        ]);

        // Mengembalikan view dengan data registrations
        return view('siswa.registration.index', compact('user'));
    }
}
