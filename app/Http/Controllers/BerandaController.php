<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bidang;
use App\Models\AnakPkl;

class BerandaController extends Controller
{
    public function beranda()
    {
        return view('beranda');
    }

    public function kuotamagang()
    {
        {
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

        // Panggil view yang benar 
        return view('kuota-magang', compact(
            'bidangs',
            'totalPeserta',
            'pesertaAktif'
        ));
    }
    }
}
