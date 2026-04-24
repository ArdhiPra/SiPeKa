<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\AnakPkl;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Hitung total anak PKL
        $totalAnak = AnakPkl::count();

        // Hitung total kuota dari semua bidang
        $jumlahKuota = Bidang::sum('kuota');

        // Hitung yang sudah terisi (status Aktif)
        $terisiTotal = AnakPkl::where('status', 'Aktif')->count();

        // Hitung sisa kuota
        $sisaTotal = $jumlahKuota - $terisiTotal;

        // Ambil per bidang + hitung jumlah terisi per bidang
        $bidangs = Bidang::withCount(['anakPkl as terisi' => function($q) {
            $q->where('status', 'Aktif');
        }])->get();

        // Hitung sisa per bidang
        $bidangs->each(function($b) {
            $b->sisa = $b->kuota - $b->terisi;
        });

        return view('admin.dashboard', compact(
            'totalAnak',
            'jumlahKuota',
            'terisiTotal',
            'sisaTotal',
            'bidangs'
        ));
    }

    public function edit()
    {
        // Hitung total anak PKL
        $totalAnak = AnakPkl::count();

        // Hitung total kuota dari semua bidang
        $jumlahKuota = Bidang::sum('kuota');

        // Hitung yang sudah terisi (status Aktif)
        $terisiTotal = AnakPkl::where('status', 'Aktif')->count();

        // Hitung sisa kuota
        $sisaTotal = $jumlahKuota - $terisiTotal;

        // Ambil per bidang + hitung jumlah terisi per bidang
        $bidangs = Bidang::withCount(['anakPkl as terisi' => function($q) {
            $q->where('status', 'Aktif');
        }])->get();

        // Hitung sisa per bidang
        $bidangs->each(function($b) {
            $b->sisa = $b->kuota - $b->terisi;
        });

        return view('admin.edit-dashboard', compact(
            'totalAnak',
            'jumlahKuota',
            'terisiTotal',
            'sisaTotal',
            'bidangs'
        ));
    }
}
