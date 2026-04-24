<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Admin\TambahController;
use App\Http\Controllers\Admin\EditController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\User\ProfilController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\ProfilMahasiswaController;
use App\Http\Controllers\User\PengajuanMagangController;
use App\Http\Controllers\Admin\PengajuanController;

Route::get('/', [BerandaController::class, 'beranda'])->name('beranda');
Route::get('/kuota', [BerandaController::class, 'kuotamagang'])->name('kuota.magang');

Route::get('/login', [LoginRegisterController::class, 'halamanLogin'])->name('login');
Route::post('/login', [LoginRegisterController::class, 'login']);

Route::get('/register', [LoginRegisterController::class, 'halamanRegister']);
Route::post('/register', [LoginRegisterController::class, 'register']);
Route::get('/verify-email/{token}', [LoginRegisterController::class, 'verifyEmail'])->name('verify.email');


Route::get('/forgot-password', [ResetPasswordController::class, 'showForgotForm']);
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink']);

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm']);
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);

Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');



Route::middleware(['role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/tentang', [DashboardController::class, 'tentang'])->name('tentang');
    Route::get('/user/profil', [ProfilController::class, 'index'])->name('user.profil');
    Route::post('/user/profil', [ProfilController::class, 'store'])->name('user.profil.store');
    Route::post('/user/profil/foto', [ProfilController::class, 'deleteFoto'])->name('user.profil.deleteFoto');
    Route::get('/user/pengajuan-magang', [PengajuanMagangController::class, 'create'])->name('user.pengajuan.magang');
    Route::post('/user/pengajuan-magang', [PengajuanMagangController::class, 'store'])->name('user.pengajuan.magang.store');
    Route::post('/user/profil/sandi', [ProfilController::class, 'gantiSandi'])->name('user.profil.sandi');
    Route::post('/user/notifikasi/read', [ProfilController::class, 'markAsRead'])->name('user.notifikasi.read');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/edit', [AdminDashboardController::class, 'edit'])->name('admin.edit.dashboard');
    Route::get('/admin/magang/create', [TambahController::class, 'create'])->name('admin.magang.create');
    Route::post('/admin/magang/store', [TambahController::class, 'store'])->name('admin.magang.store');
    Route::get('/admin/edit', [EditController::class, 'index'])->name('admin.edit.index'); // halaman daftar mahasiswa
    Route::get('/admin/edit/{id}', [EditController::class, 'edit'])->name('admin.edit.form'); // form edit
    Route::put('/admin/edit/{id}', [EditController::class, 'update'])->name('admin.edit.update'); // simpan perubahan
    Route::delete('/admin/edit/{id}', [EditController::class, 'destroy'])->name('admin.edit.destroy'); // hapus data

    Route::get('/admin/bidang/tambah', [BidangController::class, 'create'])->name('admin.bidang.tambah');
    Route::post('/admin/bidang/', [BidangController::class, 'store'])->name('admin.bidang.store');
    Route::get('/admin/bidang/{id}/edit', [BidangController::class, 'edit'])->name('admin.bidang.edit');
    Route::put('/admin/bidang/{id}', [BidangController::class, 'update'])->name('admin.bidang.update');
    Route::delete('/admin/bidang/{id}', [BidangController::class, 'destroy'])->name('admin.bidang.destroy');
    Route::get('/admin/bidang/{bidang:slug}', [BidangController::class, 'show'] )->name('admin.bidang.show');

    Route::get('/admin/magang/profil/{id}', [ProfilMahasiswaController::class, 'show']
    )->name('admin.profil.mahasiswa');


    Route::get('/admin/pengajuan', [PengajuanController::class, 'index'])->name('admin.pengajuan.index');
    Route::get('/admin/pengajuan/{id}', [PengajuanController::class, 'show'])->name('admin.pengajuan.show');
    Route::post('/admin/pengajuan/{id}/terima', [PengajuanController::class, 'terima'])->name('admin.pengajuan.terima');
    Route::post('/admin/pengajuan/{id}/tolak', [PengajuanController::class, 'tolak'])->name('admin.pengajuan.tolak');
});





