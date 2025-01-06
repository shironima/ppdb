<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Cek role pengguna dan arahkan ke halaman sesuai
        if ($user->role === 'admin') {
            return view('profile.admin.edit', ['user' => $user]);
        }

        // Untuk siswa
        return view('profile.siswa.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Mengisi data user dengan data yang sudah divalidasi
        $user->fill($request->validated());

        // Jika email diubah, reset verifikasi email
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Memeriksa apakah ada perubahan password
        if ($request->has('password') && !empty($request->password)) {
            // Pastikan password baru di-hash
            $user->password = bcrypt($request->password);
        }

        // Debugging: Tampilkan data yang telah divalidasi untuk memastikan semuanya benar
        //dd($user->getAttributes());  // Menampilkan semua atribut user sebelum disimpan

        // Simpan perubahan
        $user->save();

        // Redirect sesuai role pengguna dengan SweetAlert status
        return Redirect::route(
            $user->role === 'admin' ? 'admin.profile.edit' : 'siswa.profile.edit'
        )->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Logout pengguna dan hapus akun
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect dengan SweetAlert status
        return Redirect::to('/')->with('status', 'account-deleted');
    }

}
