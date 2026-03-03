<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magang;
use App\Models\Bidang;

class BidangController extends Controller
{
    /**
     * Menampilkan daftar mahasiswa magang khusus bidang Sekretariat
     */
    public function sekretariat()
    {
        // Ambil ID bidang "Sekretariat"
        $bidang = Bidang::where('nama_bidang', 'LIKE', '%Sekretariat%')->first();

        if (!$bidang) {
            return back()->withErrors(['msg' => 'Bidang Sekretariat tidak ditemukan di database.']);
        }

        // Ambil semua magang dengan unit_penempatan sesuai bidang sekretariat
        $magang = Magang::with('bidang')
            ->where('unit_penempatan', $bidang->id) // gunakan unit_penempatan, bukan bidang_id
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        return view('admin.bidang.bidang-sekretariat', compact('magang', 'bidang'));
    }

    public function persandian()
    {
        $bidang = Bidang::where('nama_bidang', 'LIKE', '%Persandian%')->first();

        if (!$bidang) {
            return back()->withErrors(['msg' => 'Bidang Persandian tidak ditemukan di database.']);
        }

        $magang = Magang::with('bidang')
            ->where('unit_penempatan', $bidang->id) // gunakan unit_penempatan, bukan bidang_id
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        return view('admin.bidang.bidang-persandian', compact('magang', 'bidang'));
    }

    public function pikp()
    {
        $bidang = Bidang::where('nama_bidang', 'LIKE', '%PIKP%')->first();

        if (!$bidang) {
            return back()->withErrors(['msg' => 'Bidang PIKP tidak ditemukan di database.']);
        }

        $magang = Magang::with('bidang')
            ->where('unit_penempatan', $bidang->id) // gunakan unit_penempatan, bukan bidang_id
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        return view('admin.bidang.bidang-pikp', compact('magang', 'bidang'));
    }

    public function statistik()
    {
        $bidang = Bidang::where('nama_bidang', 'LIKE', '%Statistik%')->first();

        if (!$bidang) {
            return back()->withErrors(['msg' => 'Bidang Statistik tidak ditemukan di database.']);
        }

        $magang = Magang::with('bidang')
            ->where('unit_penempatan', $bidang->id) // gunakan unit_penempatan, bukan bidang_id
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        return view('admin.bidang.bidang-statistik', compact('magang', 'bidang'));
    }

    public function tik()
    {
        $bidang = Bidang::where('nama_bidang', 'LIKE', '%TIK%')->first();

        if (!$bidang) {
            return back()->withErrors(['msg' => 'Bidang TIK tidak ditemukan di database.']);
        }

        $magang = Magang::with('bidang')
            ->where('unit_penempatan', $bidang->id) // gunakan unit_penempatan, bukan bidang_id
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        return view('admin.bidang.bidang-tik', compact('magang', 'bidang'));
    }
}
