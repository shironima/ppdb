<?php

use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalonSiswaController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\AlamatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/informasi-ppdb', function () {
    return view('nav-page.informasippdb');
})->name('nav-page.informasippdb');

Route::get('/alur-pendaftaran', function () {
    return view('nav-page.alurpendaftaran');
})->name('nav-page.alurpendaftaran');

Route::get('/biaya-pendidikan', function () {
    return view('nav-page.biayapendidikan');
})->name('nav-page.biayapendidikan');

// Dashboard untuk pelamar
Route::get('dashboard', function () {
    return view('siswa.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute untuk pengguna yang sudah login
Route::middleware('auth')->group(function () {
    // Rute profile untuk pengguna (siswa atau admin)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Data Diri Calon Siswa
    Route::get('/data-diri', [CalonSiswaController::class, 'show'])->name('calon-siswa.show');
    Route::get('/data-diri/create', [CalonSiswaController::class, 'create'])->name('calon-siswa.create');
    Route::post('/data-diri', [CalonSiswaController::class, 'store'])->name('calon-siswa.store');
    Route::get('/data-diri/edit', [CalonSiswaController::class, 'edit'])->name('calon-siswa.edit');
    Route::put('/data-diri', [CalonSiswaController::class, 'update'])->name('calon-siswa.update');
    Route::delete('/data-diri', [CalonSiswaController::class, 'destroy'])->name('calon-siswa.destroy');  

    // Alamat
    Route::get('/alamat', [AlamatController::class, 'show'])->name('alamat.show');
    Route::get('/alamat/edit', [AlamatController::class, 'edit'])->name('alamat.edit');
    Route::post('/alamat/update', [AlamatController::class, 'update'])->name('alamat.update');
    Route::post('/alamat/store', [AlamatController::class, 'store'])->name('alamat.store');
});


// Rute untuk Admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    // Rute dashboard untuk admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Rute profile untuk admin
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__.'/auth.php';
