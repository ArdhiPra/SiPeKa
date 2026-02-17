<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
            return back()->with('error', 'Email tidak ditemukan');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah');
        }

        // Simpan session
        Session::put('user_id', $user->id);
        Session::put('nama', $user->nama);
        Session::put('role', $user->role);

        // Redirect berdasarkan role
        if ($user->role == 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/user/dashboard');
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
        $request->validate([
            'nama' => 'required|max:50',
            'email' => 'required|email|unique:tbl_user,email',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => 'user',
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat, silakan login');
    }

    // ======================
    // LOGOUT
    // ======================
    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
