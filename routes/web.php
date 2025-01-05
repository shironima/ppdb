<?php

use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KelolaAkunController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalonSiswaController;
use App\Http\Controllers\DataOrangTuaController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\DataRinciController;
use App\Http\Controllers\BerkasPendidikanController;
use App\Http\Controllers\NotificationContactController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminVerifikasiPendaftaranController;
use App\Http\Controllers\AdminVerifikasiBerkasPendidikanController;
use App\Http\Controllers\AdminPenerimaanCalonSiswaController;
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

// Rute untuk pengguna yang sudah login
Route::middleware(['auth', RoleMiddleware::class . ':siswa'])->group(function () {

    // Dashboard untuk calon siswa
    Route::get('/dashboard', function () {
        return view('siswa.dashboard');
    })->name('dashboard');

    // Rute profile untuk pengguna (siswa)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('siswa.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('siswa.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('siswa.profile.destroy');

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
    Route::get('/data-diri/{id}/edit', [CalonSiswaController::class, 'edit'])->name('calon-siswa.edit');
    Route::put('/data-diri/{id}', [CalonSiswaController::class, 'update'])->name('calon-siswa.update');
    Route::delete('/data-diri', [CalonSiswaController::class, 'destroy'])->name('calon-siswa.destroy');  

    // Alamat
    Route::get('/alamat', [AlamatController::class, 'index'])->name('alamat.index');
    Route::get('/alamat/create', [AlamatController::class, 'create'])->name('alamat.create');
    Route::post('/alamat/store', [AlamatController::class, 'store'])->name('alamat.store');
    Route::get('/alamat/edit/{id}', [AlamatController::class, 'edit'])->name('alamat.edit');  
    Route::put('/alamat/update/{id}', [AlamatController::class, 'update'])->name('alamat.update'); 

    // Data Orang Tua
    Route::get('/data-orang-tua', [DataOrangTuaController::class, 'index'])->name('data-orang-tua.index');
    Route::get('/data-orang-tua/create', [DataOrangTuaController::class, 'create'])->name('data-orang-tua.create');
    Route::post('/data-orang-tua/store', [DataOrangTuaController::class, 'store'])->name('data-orang-tua.store');
    Route::get('/data-orang-tua/edit/{id}', [DataOrangTuaController::class, 'edit'])->name('data-orang-tua.edit');
    Route::put('/data-orang-tua/update/{id}', [DataOrangTuaController::class, 'update'])->name('data-orang-tua.update');

    // Data Rinci Calon Siswa
    Route::get('/data-rinci', [DataRinciController::class, 'index'])->name('data-rinci.index');
    Route::get('/data-rinci/create', [DataRinciController::class, 'create'])->name('data-rinci.create');
    Route::post('/data-rinci/store', [DataRinciController::class, 'store'])->name('data-rinci.store');
    Route::get('/data-rinci/{id}/edit', [DataRinciController::class, 'edit'])->name('data-rinci.edit');
    Route::put('/data-rinci/{id}', [DataRinciController::class, 'update'])->name('data-rinci.update');

    // Berkas Pendidikan
    Route::get('/berkas-pendidikan', [BerkasPendidikanController::class, 'index'])->name('berkas-pendidikan.index');
    Route::get('/berkas-pendidikan/create', [BerkasPendidikanController::class, 'create'])->name('berkas-pendidikan.create');
    Route::post('/berkas-pendidikan/store', [BerkasPendidikanController::class, 'store'])->name('berkas-pendidikan.store');
    Route::get('/berkas-pendidikan/edit/{id}', [BerkasPendidikanController::class, 'edit'])->name('berkas-pendidikan.edit');
    Route::put('/berkas-pendidikan/update/{id}', [BerkasPendidikanController::class, 'update'])->name('berkas-pendidikan.update');
    
    // Status Pendaftaran
    Route::get('/status-pendaftaran', [RegistrationController::class, 'index'])->name('status-pendaftaran.index');

    // Notification Contact
    Route::get('/notification-contact', [NotificationContactController::class, 'index'])->name('notification.index'); 
    Route::post('/notification-contact', [NotificationContactController::class, 'store'])->name('notification.store'); 
    Route::put('/notification-contact/update/{id}', [NotificationContactController::class, 'update'])->name('notification.update');
    Route::delete('/notification-contact/{id}', [NotificationContactController::class, 'destroy'])->name('notification.destroy');

    // Kirim Notifikasi - kirim pendaftaran ke admin
    Route::get('/send-notification', [RegistrationController::class, 'sendNotification'])->name('send-notification');
    Route::post('/registration/submit', [RegistrationController::class, 'submit'])->name('registration.submit');
    Route::post('/registration/update', [RegistrationController::class, 'update'])->name('registration.update');

});


// Rute untuk Admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    // Dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Notifikasi Admin (email dan whatsapp)
    Route::get('/admin/admin-contact/email', [AdminController::class, 'indexEmail'])->name('admin.admin-contact.email');
    Route::get('/admin/admin-contact/email/create', [AdminController::class, 'createEmail'])->name('admin.admin-contact.create');
    Route::post('/admin/admin-contact/email', [AdminController::class, 'storeEmail'])->name('admin.admin-contact.store');
    Route::put('/admin/admin-contact/email', [AdminController::class, 'updateEmail'])->name('admin.admin-contact.email.update');
    
    Route::get('/admin/admin-contact/whatsapp', [AdminController::class, 'indexWhatsapp'])->name('admin.admin-contact.whatsapp');
    Route::get('/admin/admin-contact/whatsapp/create', [AdminController::class, 'createWhatsapp'])->name('admin.admin-contact.create.whatsapp');
    Route::post('/admin/admin-contact/whatsapp', [AdminController::class, 'storeWhatsapp'])->name('admin.admin-contact.store.whatsapp');
    Route::put('/admin/admin-contact/whatsapp', [AdminController::class, 'updateWhatsapp'])->name('admin.admin-contact.whatsapp.update');

    Route::delete('/admin/admin-contact/{id}', [AdminController::class, 'destroy'])->name('admin.admin-contact.destroy');

    // Verifikasi Penerimaan Calon Siswa
    Route::get('verifikasi-pendaftaran', [AdminPenerimaanCalonSiswaController::class, 'index'])->name('verifikasi-pendaftaran.index');
    Route::get('verifikasi-pendaftaran/{id}', [AdminPenerimaanCalonSiswaController::class, 'show'])->name('verifikasi-pendaftaran.show');
    Route::put('verifikasi-pendaftaran/{id}', [AdminPenerimaanCalonSiswaController::class, 'update'])->name('verifikasi-pendaftaran.update');
    Route::delete('verifikasi-pendaftaran/{id}', [AdminPenerimaanCalonSiswaController::class, 'destroy'])->name('verifikasi-pendaftaran.destroy');

    // Verifikasi Pendaftaran
    Route::get('/admin/verifikasi-pendaftaran', [AdminVerifikasiPendaftaranController::class, 'index'])->name('admin.verifikasi-pendaftaran.index');
    Route::get('/admin/verifikasi-pendaftaran/{id}', [AdminVerifikasiPendaftaranController::class, 'show'])->name('admin.verifikasi-pendaftaran.show');
    Route::get('admin/kelola-pendaftaran/pendaftaran-siswa-baru/verifikasi', [AdminVerifikasiPendaftaranController::class, 'needVerify'])->name('admin.verifikasi-pendaftaran.verify');
    Route::put('/admin/verifikasi-pendaftaran/{id}/reject', [AdminVerifikasiPendaftaranController::class, 'reject'])->name('admin.verifikasi-pendaftaran.reject');
    Route::delete('/admin/verifikasi-pendaftaran/{id}', [AdminVerifikasiPendaftaranController::class, 'destroy'])->name('admin.verifikasi-pendaftaran.destroy');
    Route::put('/admin/verifikasi-pendaftaran/update-status/{type}/{id}', [AdminVerifikasiPendaftaranController::class, 'updateStatus'])->name('admin.verifikasi-pendaftaran.updateStatus');
    Route::put('/admin/verifikasi-pendaftaran/update-comment/{type}/{id}', [AdminVerifikasiPendaftaranController::class, 'updateComment'])->name('admin.verifikasi-pendaftaran.updateComment');

    // Verifikasi Berkas Pendidikan
    Route::get('/admin/verifikasi-berkas-pendidikan', [AdminVerifikasiBerkasPendidikanController::class, 'index'])->name('admin.verifikasi-berkas-pendidikan.index');
    Route::get('/admin/verifikasi-berkas-pendidikan/{id}', [AdminVerifikasiBerkasPendidikanController::class, 'show'])->name('admin.verifikasi-berkas-pendidikan.show');
    Route::get('/admin/verifikasi-berkas-pendidikan/verifikasi', [AdminVerifikasiBerkasPendidikanController::class, 'needVerify'])->name('admin.verifikasi-berkas-pendidikan.verify');
    Route::put('/admin/verifikasi-berkas-pendidikan/{id}/reject', [AdminVerifikasiBerkasPendidikanController::class, 'reject'])->name('admin.verifikasi-berkas-pendidikan.reject');
    Route::delete('/admin/verifikasi-berkas-pendidikan/{id}', [AdminVerifikasiBerkasPendidikanController::class, 'destroy'])->name('admin.verifikasi-berkas-pendidikan.destroy');
    Route::put('/admin/verifikasi-berkas-pendidikan/update-status/{id}', [AdminVerifikasiBerkasPendidikanController::class, 'updateStatus'])->name('admin.verifikasi-berkas-pendidikan.updateStatus');
    Route::put('/admin/verifikasi-berkas-pendidikan/update-comment/{id}', [AdminVerifikasiBerkasPendidikanController::class, 'updateComment'])->name('admin.verifikasi-berkas-pendidikan.updateComment');
    
    // Tanya Admin - Jawaban
    Route::get('/admin/hubungi-admin', [JawabanController::class, 'index'])->name('admin.hubungi-admin.index');
    Route::post('/admin/hubungi-admin/{id}', [JawabanController::class, 'store'])->name('admin.hubungi-admin.store');
    Route::get('/admin/hubungi-admin/menunggu', [JawabanController::class, 'menungguJawaban'])->name('admin.hubungi-admin.menunggu');
    
    // profile untuk admin
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');

    // Kelola Akun - Akun role : Admin
    Route::get('/admin/kelola-akun/admin', [KelolaAkunController::class, 'indexAdmin'])->name('admin.kelola-akun.admin');
    Route::get('/admin/kelola-akun/admin/create', [KelolaAkunController::class, 'createAkunAdmin'])->name('admin.kelola-akun.admin.create');
    Route::post('/admin/kelola-akun/admin/store', [KelolaAkunController::class, 'storeAkunAdmin'])->name('admin.kelola-akun.admin.store');
    Route::get('/admin/kelola-akun/admin/edit/{id}', [KelolaAkunController::class, 'editAkunAdmin'])->name('admin.kelola-akun.admin.edit');
    Route::put('/admin/kelola-akun/admin/update/{id}', [KelolaAkunController::class, 'updateAkunAdmin'])->name('admin.kelola-akun.admin.update');
    Route::delete('/admin/kelola-akun/admin/{id}', [KelolaAkunController::class, 'destroyAkunAdmin'])->name('admin.kelola-akun.admin.destroy');

    // Kelola Akun - Akun role : Siswa
    Route::get('/admin/kelola-akun/siswa', [KelolaAkunController::class, 'indexSiswa'])->name('admin.kelola-akun.siswa');
    Route::get('/admin/kelola-akun/siswa/create', [KelolaAkunController::class, 'createAkunSiswa'])->name('admin.kelola-akun.siswa.create');
    Route::post('/admin/kelola-akun/siswa/store', [KelolaAkunController::class, 'storeAkunSiswa'])->name('admin.kelola-akun.siswa.store');
    Route::get('/admin/kelola-akun/siswa/edit/{id}', [KelolaAkunController::class, 'editAkunSiswa'])->name('admin.kelola-akun.siswa.edit');
    Route::put('/admin/kelola-akun/siswa/update/{id}', [KelolaAkunController::class, 'updateAkunSiswa'])->name('admin.kelola-akun.siswa.update');
    Route::delete('/admin/kelola-akun/siswa/{id}', [KelolaAkunController::class, 'destroyAkunSiswa'])->name('admin.kelola-akun.siswa.destroy');
});

require __DIR__.'/auth.php';
