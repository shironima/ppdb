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

        // Jika pengguna adalah admin, arahkan ke halaman profile admin
        if ($user->hasRole('admin')) {
            return view('profile.admin.edit', ['user' => $user]);
        }

        // Jika pengguna bukan admin (role : siswa), arahkan ke halaman profile biasa
        return view('profile.edit', [
            'user' => $request->user(),
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

        // Jika ada perubahan pada email, set email_verified_at menjadi null
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Simpan perubahan
        $user->save();

        // Jika pengguna adalah admin, arahkan ke halaman admin profile setelah update
        if ($user->hasRole('admin')) {
            return Redirect::route('profile.admin.edit')->with('status', 'profile-updated');
        }

        // Jika pengguna bukan admin, arahkan ke halaman profile biasa setelah update
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validasi password saat menghapus akun
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Logout pengguna dan hapus akun
        Auth::logout();
        $user->delete();

        // Invalidate session dan regenerate token untuk logout yang aman
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
