<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanMagang;
use App\Models\Bidang;
use App\Models\Profil;
use Illuminate\Support\Facades\Auth;

class PengajuanMagangController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $bidangs = Bidang::all();
        $profil = Profil::where('user_id', $user->id)->first();

        // ✅ Validasi minimal profil
        if (!$profil ||
            !$profil->nama_lengkap ||
            !$profil->nomor_induk ||
            !$profil->tingkat
        ) {
            return redirect()->back()->with('sweetalert', [
            'icon'  => 'error',
            'title' => 'Profil Belum Lengkap!',
            'text'  => 'Lengkapi profil utama (nama, nomor induk, tingkat) terlebih dahulu.',
            ]);}

        return view('user.pengajuan-magang', compact('user', 'bidangs', 'profil'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bidang_id' => 'required|exists:tbl_bidang,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'file_pengajuan' => 'required|file|mimes:pdf|max:2048',        
        ]);

        $user = Auth::user();
        $profil = Profil::where('user_id', $user->id)->first();

        // ❌ Cegah double pengajuan
        $cek = PengajuanMagang::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'diterima'])
            ->exists();

        if ($cek) {
            return back()->with('sweetalert', [
            'icon'  => 'warning',
            'title' => 'Perhatian!',
            'text'  => 'Kamu sudah mengajukan magang sebelumnya.',
            ]);}

        // 🔥 VALIDASI KUOTA (SUDAH FIX KE bidang_id)
        $jumlah = PengajuanMagang::where('bidang_id', $request->bidang_id)
            ->where('status', 'diterima')
            ->count();

        $bidang = Bidang::find($request->bidang_id);

        if ($jumlah >= $bidang->kuota) {
            return back()->with('sweetalert', [
            'icon'  => 'error',
            'title' => 'Kuota Penuh!',
            'text'  => 'Bidang ini sudah penuh, silakan pilih bidang lain.',
        ]);
        }

        // upload file
        $file = $request->file('file_pengajuan');
        $path = $file->store('pengajuan', 'public');

        // ✅ SIMPAN (AMBIL DARI PROFIL, BUKAN USER)
        PengajuanMagang::create([
            'user_id' => $user->id,
            'bidang_id' => $request->bidang_id,

            'nama' => $profil->nama_lengkap,
            'nomor_induk' => $profil->nomor_induk,
            'program_studi' => $profil->program_studi,
            'tingkat' => $profil->tingkat ?? $request->tingkat,

            'file_pengajuan' => $path,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,

            'status' => 'pending'
        ]);

        return redirect()->route('user.dashboard')
    ->with('sweetalert', [
        'icon'  => 'success',
        'title' => 'Berhasil!',
        'text'  => 'Pengajuan magang kamu berhasil dikirim!',
    ]);
    }
}