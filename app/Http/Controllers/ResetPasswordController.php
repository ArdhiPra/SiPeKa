<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ResetPasswordController extends Controller
{

    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('alert-error', 'Email tidak ditemukan');
        }

        $token = Str::random(64);

        $user->reset_token = $token;
        $user->reset_token_expired_at = now()->addMinutes(30);
        $user->save();

        Mail::send('emails.reset', ['token' => $token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Reset Password');
        });

        return back()->with('alert-success', 'Link reset dikirim ke email');
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::where('reset_token', $request->token)
            ->where('reset_token_expired_at', '>', now())
            ->first();

        if (!$user) {
            return back()->with('alert-error', 'Token tidak valid atau kadaluarsa');
        }

        $user->password = bcrypt($request->password);
        $user->reset_token = null;
        $user->reset_token_expired_at = null;
        $user->save();

        return redirect('/')->with('alert-success', 'Password berhasil diubah');
    }

}
