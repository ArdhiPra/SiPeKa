<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magang;
use App\Models\Bidang;
use Illuminate\Support\Facades\Auth;

class TambahController extends Controller
{
    public function create()
    {
        $bidang = Bidang::all();
        return view('admin.tambah-dashboard', compact('bidang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'asal_instansi' => 'nullable|string|max:100',
            'program_studi' => 'nullable|string|max:100',
            'tingkat' => 'nullable|in:SMA/K,D3,D4,S1,S2',
            'nomor_induk' => 'nullable|digits_between:5,20|unique:tbl_anak_pkl,nomor_induk',
            'no_hp' => 'nullable|string|max:15',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat_domisili' => 'nullable|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'bidang_id' => 'required|exists:tbl_bidang,id',
            'pembimbing_instansi' => 'nullable|string|max:150',
            'pembimbing_lapangan' => 'nullable|string|max:150',
            'status' => 'required|in:Aktif,Selesai,Diberhentikan',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'nomor_induk.digits_between' => 'NIM harus berupa angka minimal 5 digit.',
            'nomor_induk.unique' => 'NIM sudah terdaftar.',
            'bidang_id.required' => 'Bidang wajib dipilih.',
        ]);

        // Tambahkan user_id otomatis (admin yang menambahkan)
        $validated['user_id'] = Auth::id();

        Magang::create($validated);

        return redirect()->back()->with('alert-success', 'Data magang berhasil ditambahkan!');
    }
}