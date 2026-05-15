<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\PengajuanMagang;
use Illuminate\Support\Facades\Storage;


class ProfilController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $profil = Profil::where('user_id', Auth::id())->first();

        // Auto mark as read jika buka tab notifikasi
        if ($request->get('tab') === 'notifikasi') {
            PengajuanMagang::where('user_id', $user->id)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        $pengajuanList     = PengajuanMagang::where('user_id', $user->id)->with('bidang')->latest()->get();
        $pengajuanTerakhir = $pengajuanList->first();
        $notifCount        = PengajuanMagang::where('user_id', $user->id)
                                ->where('is_read', false)
                                ->count();
        $notifStatus       = $pengajuanTerakhir ? $pengajuanTerakhir->status : null;

        return view('user.user-profil', compact('profil', 'pengajuanList', 'notifCount', 'notifStatus'));
    }

    public function store(Request $request)
{
    $userId = Auth::id();

    $validated = $request->validate([
        'nama_lengkap' => 'required|string|max:150',
        'nomor_induk' => 'required|string|max:20|unique:tbl_profil,nomor_induk,' . $userId . ',user_id',
        'asal_instansi' => 'nullable|string|max:100',
        'program_studi' => 'nullable|string|max:100',
        'tingkat'       => 'nullable|in:SMA/K,D3,D4,S1,S2',
        'telepon' => 'required|string|max:15',
        'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
        'alamat_domisili' => 'required|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $profil = Profil::where('user_id', $userId)->first();

    if ($request->hasFile('foto')) {

        if ($profil && $profil->foto && Storage::exists('public/' . $profil->foto)) {
            Storage::delete('public/' . $profil->foto);
        }

        $path = $request->file('foto')->store('foto_profil', 'public');
        $validated['foto'] = $path;
    }

    Profil::updateOrCreate(
        ['user_id' => $userId],
        $validated
    );

    return back()->with('sweetalert', [
    'icon'  => 'success',
    'title' => 'Berhasil!',
    'text'  => 'Profil berhasil disimpan!',
    ]);
    }

    // ProfilController.php
public function gantiSandi(Request $request)
{
    $request->validate([
        'sandi_lama' => 'required',
        'sandi_baru' => 'required|min:8|confirmed',
    ], [
        'sandi_lama.required' => 'Sandi lama wajib diisi.',
        'sandi_baru.required' => 'Sandi baru wajib diisi.',
        'sandi_baru.min'      => 'Sandi baru minimal 8 karakter.',
        'sandi_baru.confirmed'=> 'Konfirmasi sandi tidak cocok.',
    ]);

    // Cek sandi lama
    if (!Hash::check($request->sandi_lama, Auth::user()->password)) {
        return back()
            ->withErrors(['sandi_lama' => 'Sandi lama tidak sesuai.'])
            ->with('tab', 'sandi');
    }

    $user = Auth::user();
    $user->password = Hash::make($request->sandi_baru);
    $user->save();
    return back()->with('sweetalert', [
        'icon'  => 'success',
        'title' => 'Berhasil!',
        'text'  => 'Sandi berhasil diubah!',
    ])->with('tab', 'sandi');
}

public function notifikasi()
    {
        $user = Auth::user();
        $pengajuan = PengajuanMagang::where('user_id', $user->id)->latest()->first();
        $notifCount = PengajuanMagang::where('user_id', $user->id)->count();
        $notifStatus = $pengajuan ? $pengajuan->status : null; // 'pending', 'diterima', 'ditolak'
        return view('user.profil', compact('profil', 'notifCount', 'notifStatus'));
    }

    public function markAsRead()
{
    PengajuanMagang::where('user_id', Auth::id())
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return response()->json(['success' => true]);
}

    public function deleteFoto()
{
    $profil = Auth::user()->profil;

    if (!$profil) {
        return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan']);
    }

    if ($profil->foto) {
        // Hapus file fisik dari storage
        Storage::disk('public')->delete($profil->foto);

        // ← INI YANG SERING LUPA: set null di DB
        $profil->foto = null;
        $profil->save();
    }

    return response()->json(['success' => true]);
}
}

