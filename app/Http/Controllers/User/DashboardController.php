<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\AnakPkl;
use App\Models\PengajuanMagang;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil per bidang + hitung jumlah terisi per bidang
        $bidangs = Bidang::withCount(['anakPkl as terisi' => function($q) {
            $q->where('status', 'Aktif');
        }])->get();

        // Hitung sisa per bidang
        $bidangs->each(function($b) {
            $b->sisa = $b->kuota - $b->terisi;
        });

        // Tambahan data ringkasan
        $totalPeserta = AnakPkl::count();
        $pesertaAktif = AnakPkl::where('status', 'Aktif')->count();

        // Data notifikasi pengajuan
        $pengajuanTerakhir = PengajuanMagang::where('user_id', $user->id)
                                ->latest()
                                ->first();

        $notifCount = PengajuanMagang::where('user_id', $user->id)
                        ->where('is_read', false)
                        ->count();

        // Status dari pengajuan yang belum dibaca (untuk warna badge)
        $pengajuanBelumDibaca = PengajuanMagang::where('user_id', $user->id)
                                    ->where('is_read', false)
                                    ->latest()
                                    ->first();

        $notifStatus = $pengajuanBelumDibaca ? $pengajuanBelumDibaca->status : null;

        return view('user.dashboard', compact(
            'bidangs',
            'totalPeserta',
            'pesertaAktif',
            'notifCount',
            'notifStatus'
        ));
    }

    public function tentang()
    {
        return view('tentang');
    }
}