<?php

use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalonSiswaController;
use App\Http\Controllers\DataOrangTuaController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\JawabanController;
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

// Dashboard untuk calon siswa
Route::get('dashboard', function () {
    return view('siswa.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute untuk pengguna yang sudah login
Route::middleware('auth')->group(function () {
    // Rute profile untuk pengguna (siswa atau admin)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Informasi PPDB
    Route::view('/info-ppdb/alur-pendaftaran', 'siswa.informasi-ppdb.alur-pendaftaran')->name('siswa.informasi-ppdb.alur-pendaftaran');
    Route::view('/info-ppdb/info-ppdb', 'siswa.informasi-ppdb.info-pendaftaran')->name('siswa.informasi-ppdb.info-pendaftaran');
    Route::view('/info-ppdb/biaya-pendidikan', 'siswa.informasi-ppdb.biaya-pendidikan')->name('siswa.informasi-ppdb.biaya-pendidikan');

    // Tanya Admin PPDB
    Route::get('/informasi-ppdb/tanya-admin-ppdb', [PertanyaanController::class, 'index'])->name('siswa.informasi-ppdb.tanya-admin-ppdb');
    Route::post('/informasi-ppdb/tanya-admin-ppdb', [PertanyaanController::class, 'store'])->name('siswa.informasi-ppdb.tanya-admin-ppdb.store');
    
    // Data Diri Calon Siswa
    Route::get('/data-diri', [CalonSiswaController::class, 'index'])->name('calon-siswa.index');
    Route::get('/data-diri/create', [CalonSiswaController::class, 'create'])->name('calon-siswa.create');
    Route::post('/data-diri', [CalonSiswaController::class, 'store'])->name('calon-siswa.store');
    Route::get('/data-diri/edit', [CalonSiswaController::class, 'edit'])->name('calon-siswa.edit');
    Route::put('/data-diri', [CalonSiswaController::class, 'update'])->name('calon-siswa.update');
    Route::delete('/data-diri', [CalonSiswaController::class, 'destroy'])->name('calon-siswa.destroy');  

    // Alamat
    Route::get('/alamat', [AlamatController::class, 'index'])->name('alamat.index');
    Route::get('/alamat/create', [AlamatController::class, 'create'])->name('alamat.create');
    Route::post('/alamat/store', [AlamatController::class, 'store'])->name('alamat.store');
    Route::get('/alamat/edit', [AlamatController::class, 'edit'])->name('alamat.edit');
    Route::post('/alamat/update', [AlamatController::class, 'update'])->name('alamat.update');

    // Data Orang Tua
    Route::get('/data-orang-tua', [DataOrangTuaController::class, 'index'])->name('data-orang-tua.index');
    Route::get('/data-orang-tua/create', [DataOrangTuaController::class, 'create'])->name('data-orang-tua.create');
    Route::post('/data-orang-tua/store', [DataOrangTuaController::class, 'store'])->name('data-orang-tua.store');
    Route::get('/data-orang-tua/edit', [DataOrangTuaController::class, 'edit'])->name('data-orang-tua.edit');
    Route::post('/data-orang-tua/update', [DataOrangTuaController::class, 'update'])->name('data-orang-tua.update');
    
});


// Rute untuk Admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    // Rute dashboard untuk admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Tanya Admin - Jawaban
    Route::get('/admin/hubungi-admin', [JawabanController::class, 'index'])->name('admin.hubungi-admin.index');
    Route::post('/admin/hubungi-admin/{id}', [JawabanController::class, 'store'])->name('admin.hubungi-admin.store');
    Route::get('/admin/hubungi-admin/menunggu', [JawabanController::class, 'menungguJawaban'])->name('admin.hubungi-admin.menunggu');
    
    // Rute profile untuk admin
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__.'/auth.php';
