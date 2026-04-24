<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Magang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class LoginRegisterController extends Controller
{
    // ======================
    // HALAMAN LOGIN
    // ======================
    public function halamanLogin()
    {
        return view('auth.login');
    }

    // ======================
    // PROSES LOGIN
    // ======================
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->with('alert-error', 'Email tidak ditemukan');
    }

    if (!$user->email_verified_at) {
        return back()->with('alert-error', 'Silakan verifikasi email terlebih dahulu');
    }

    if (!Hash::check($request->password, $user->password)) {
        return back()->with('alert-error', 'Password salah');
    }

    Auth::login($user);

    // Redirect berdasarkan role
    if (strtolower($user->role) === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
}

    // ======================
    // HALAMAN REGISTER
    // ======================
    public function halamanRegister()
    {
        return view('auth.register');
    }

    // ======================
    // PROSES REGISTER
    // ======================
    public function register(Request $request)
{
    $validated = $request->validate([
        'nama'     => 'required|string|max:100',
        'email'    => 'required|email|unique:tbl_user,email',
        'password' => 'required|min:6|confirmed',
    ]);

    // Generate token unik
    $token = Str::random(64);

    $user = User::create([
        'nama'               => $validated['nama'],
        'email'              => $validated['email'],
        'password'           => Hash::make($validated['password']),
        'role'               => 'user',
        'verification_token' => $token, // ← simpan token
    ]);

    // Kirim email verifikasi
    $verifyUrl = route('verify.email', $token);

    Mail::send('emails.verify', ['user' => $user, 'url' => $verifyUrl], function ($mail) use ($user) {
        $mail->to($user->email)
             ->subject('Verifikasi Email Kamu');
    });

    return redirect()->route('login')
        ->with('alert-success', 'Registrasi berhasil! Silakan cek email untuk verifikasi.');
}

    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return redirect('/login')->with('alert-error', 'Token verifikasi tidak valid');
        }

        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();

        return redirect('/login')->with('alert-success', 'Email berhasil diverifikasi, silakan login');
    }
    // ======================
    // LOGOUT
    // ======================
    public function logout()
{
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
}
}
