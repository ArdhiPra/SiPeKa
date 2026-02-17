<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegisterController;

Route::get('/', function () {
    return redirect('/');
});

Route::get('/', [LoginRegisterController::class, 'halamanLogin']);
Route::post('/', [LoginRegisterController::class, 'login']);

Route::get('/register', [LoginRegisterController::class, 'halamanRegister']);
Route::post('/register', [LoginRegisterController::class, 'register']);

Route::get('/logout', [LoginRegisterController::class, 'logout']);


Route::middleware(['role:user'])->group(function () {
    Route::view('/user/dashboard', 'user.dashboard');
});

Route::middleware(['role:admin'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard');
});

