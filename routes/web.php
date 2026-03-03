<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Admin\TambahController;
use App\Http\Controllers\Admin\EditController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\User\TentangController;

Route::get('/', function () {
    return redirect('/');
});

Route::get('/', [LoginRegisterController::class, 'halamanLogin'])->name('login');
Route::post('/', [LoginRegisterController::class, 'login']);

Route::get('/register', [LoginRegisterController::class, 'halamanRegister']);
Route::post('/register', [LoginRegisterController::class, 'register']);
Route::get('/verify-email/{token}', [LoginRegisterController::class, 'verifyEmail']);


Route::get('/forgot-password', [ResetPasswordController::class, 'showForgotForm']);
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink']);

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm']);
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);

Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');



Route::middleware(['role:user'])->group(function () {
    Route::view('/user/dashboard', 'user.dashboard')->name('user.dashboard');
    route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/edit', [AdminDashboardController::class, 'edit'])->name('admin.dashboard.edit');
    Route::get('/admin/magang/create', [TambahController::class, 'create'])->name('admin.magang.create');
    Route::post('/admin/magang/store', [TambahController::class, 'store'])->name('admin.magang.store');
    Route::get('/admin/edit', [EditController::class, 'index'])->name('admin.edit.index'); // halaman daftar mahasiswa
    Route::get('/admin/edit/{id}', [EditController::class, 'edit'])->name('admin.edit.form'); // form edit
    Route::put('/admin/edit/{id}', [EditController::class, 'update'])->name('admin.edit.update'); // simpan perubahan
    Route::delete('/admin/edit/{id}', [EditController::class, 'destroy'])->name('admin.edit.destroy'); // hapus data

});

    Route::get('/admin/sekretariat', [BidangController::class, 'sekretariat'])->name('admin.sekretariat');
    Route::get('/admin/persandian', [BidangController::class, 'persandian'])->name('admin.persandian');
    Route::get('/admin/pikp', [BidangController::class, 'pikp'])->name('admin.pikp');
    Route::get('/admin/tik', [BidangController::class, 'tik'])->name('admin.tik');
    Route::get('/admin/statistik', [BidangController::class, 'statistik'])->name('admin.statistik');




