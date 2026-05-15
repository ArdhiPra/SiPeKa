<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Magang; // ✅ ganti AnakPkl → Magang
use App\Models\PengajuanMagang;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ✅ Ganti anakPkl → magang (sesuai relasi di model Bidang)
        $bidangs = Bidang::withCount(['magang as terisi' => function($q) {
            $q->where('status', 'Aktif');
        }])->get();

        // Hitung sisa per bidang
        $bidangs->each(function($b) {
            $b->sisa = max(0, $b->kuota - $b->terisi); // ✅ min 0, tidak minus
        });

        // ✅ Ganti AnakPkl → Magang
        $totalPeserta = Magang::count();
        $pesertaAktif = Magang::where('status', 'Aktif')->count();

        // Notifikasi
        $notifCount = PengajuanMagang::where('user_id', $user->id)
                        ->where('is_read', false)
                        ->count();

        $pengajuanBelumDibaca = PengajuanMagang::where('user_id', $user->id)
                                    ->where('is_read', false)
                                    ->latest()
                                    ->first();

        $notifStatus = $pengajuanBelumDibaca?->status;

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