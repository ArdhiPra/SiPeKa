<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bidang;
use App\Models\Magang; // ✅ sesuaikan dengan model yang dipakai

class BerandaController extends Controller
{
    public function beranda()
    {
        return view('beranda');
    }

    public function kuotamagang()
    {
        // Ambil semua bidang + hitung terisi dari relasi
        $bidangs = Bidang::withCount(['magang as terisi' => function($q) {
            $q->where('status', 'Aktif');
        }])->get();

        // Hitung sisa per bidang
        $bidangs->each(function($b) {
            $b->sisa = max(0, $b->kuota - $b->terisi); // ✅ min 0, tidak minus
        });

        $totalPeserta = Magang::count();
        $pesertaAktif = Magang::where('status', 'Aktif')->count();

        return view('kuota-magang', compact(
            'bidangs',
            'totalPeserta',
            'pesertaAktif'
        ));
    }
}