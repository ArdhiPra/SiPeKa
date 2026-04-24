<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanMagang;
use App\Models\AnakPkl;
use App\Models\Profil;
use Illuminate\Http\Request;


class PengajuanController extends Controller
{
    // Tampilkan semua pengajuan
    public function index()
    {
        $pengajuan = PengajuanMagang::with(['user', 'bidang'])
            ->latest()
            ->paginate(10);

        return view('admin.pengajuan.index', compact('pengajuan'));
    }

    // Detail satu pengajuan
    public function show($id)
    {
        $pengajuan = PengajuanMagang::with(['user', 'bidang'])->findOrFail($id);
        return view('admin.pengajuan.show', compact('pengajuan'));
    }

    // Terima pengajuan → masukkan ke tbl_anak_pkl
    public function terima($id)
    {
        $pengajuan = PengajuanMagang::findOrFail($id);

        if ($pengajuan->status !== 'pending') {
            return back()->with('alert-error', 'Pengajuan ini sudah diproses.');
        }

        // Ambil data profil berdasarkan user_id pengajuan
        $profil = Profil::where('user_id', $pengajuan->user_id)->first();

        AnakPkl::create([
            'user_id'           => $pengajuan->user_id,
            'bidang_id'         => $pengajuan->bidang_id,
            // Data dari tbl_pengajuan_magang
            'nama_lengkap'      => $pengajuan->nama,
            'tanggal_mulai'     => $pengajuan->tanggal_mulai,
            'tanggal_selesai'   => $pengajuan->tanggal_selesai,
            // Data dari tbl_profil
            'nomor_induk'       => $profil?->nomor_induk,
            'asal_instansi'     => $profil?->asal_instansi,
            'program_studi'     => $profil?->program_studi,
            'tingkat'           => $profil?->tingkat,
            'telepon'           => $profil?->telepon,
            'jenis_kelamin'     => $profil?->jenis_kelamin,
            'alamat_domisili'   => $profil?->alamat_domisili,
            'status'            => 'Aktif',
        ]);

        $pengajuan->update(['status' => 'diterima']);

        return redirect()->route('admin.pengajuan.index')
            ->with('alert-success', 'Pengajuan berhasil diterima.');
}

    // Tolak pengajuan
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'alasan_tolak' => 'required|string|max:500',
        ]);

        $pengajuan = PengajuanMagang::findOrFail($id);

        if ($pengajuan->status !== 'pending') {
            return back()->with('alert-error', 'Pengajuan ini sudah diproses.');
        }

        $pengajuan->update([
            'status'       => 'ditolak',
            'alasan_tolak' => $request->alasan_tolak,
        ]);

        return redirect()->route('admin.pengajuan.index')
            ->with('alert-success', 'Pengajuan berhasil ditolak.');
    }
}