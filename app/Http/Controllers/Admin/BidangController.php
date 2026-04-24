<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magang;
use App\Models\Bidang;
use Illuminate\Support\Str;

class BidangController extends Controller
{
    public function show(Bidang $bidang)
    {
        $magang = Magang::with('bidang')
            ->where('bidang_id', $bidang->id)
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        return view('admin.bidang.lihat-detail', compact('bidang', 'magang'));
    }

    public function create()
    {
        return view('admin.bidang.tambah-bidang');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bidang' => 'required',
            'kuota' => 'required|integer'
        ]);

        $slug = Str::slug($request->nama_bidang);
        $original = $slug;
        $count = 1;

        while (Bidang::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }

        Bidang::create([
            'nama_bidang' => $request->nama_bidang,
            'kuota' => $request->kuota,
            'icon' => $request->icon ?? 'bi-folder',
            'warna' => $request->warna ?? 'secondary',
            'slug' => $slug,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Bidang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $bidang = Bidang::findOrFail($id);
        return view('admin.bidang.edit-bidang', compact('bidang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bidang' => 'required',
            'kuota' => 'required|integer'
        ]);

        $bidang = Bidang::findOrFail($id);

        // Update field utama
        $bidang->nama_bidang = $request->nama_bidang;
        $bidang->kuota = $request->kuota;
        $bidang->icon = $request->icon ?? 'bi-folder';
        $bidang->warna = $request->warna ?? 'secondary';

        // 🔥 Generate slug baru
        $slug = Str::slug($request->nama_bidang);
        $original = $slug;
        $count = 1;

        // 🔒 Pastikan slug unik (kecuali dirinya sendiri)
        while (Bidang::where('slug', $slug)
            ->where('id', '!=', $bidang->id)
            ->exists()) {
            
            $slug = $original . '-' . $count++;
        }

        $bidang->slug = $slug;

        $bidang->save();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Bidang berhasil diupdate');
    }

    public function destroy($id)
    {
        $bidang = Bidang::findOrFail($id);
        $bidang->delete();

        return redirect()->route('admin.edit.dashboard')
    ->with('sweetalert', [
        'icon'  => 'success',
        'title' => 'Berhasil!',
        'text'  => 'Bidang berhasil dihapus!',
    ]);  
    }

}
