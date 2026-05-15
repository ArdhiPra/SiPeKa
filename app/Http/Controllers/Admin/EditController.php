<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magang;
use App\Models\Bidang;

class EditController extends Controller
{
    /**
     * Halaman awal edit - daftar mahasiswa magang
     */
    public function index(Request $request)
{
    $bidang = Bidang::all();

    // ✅ Tambah 'tahun' ke filters
    $filters = $request->only(['bidang', 'asal_instansi', 'status', 'tahun']);
    session(['edit_filters' => $filters]);

    $query = Magang::with('bidang');

    if (!empty($filters['bidang'])) {
        $query->where('unit_penempatan', $filters['bidang']);
    }

    if (!empty($filters['asal_instansi'])) {
        $query->where('asal_instansi', 'like', '%' . trim($filters['asal_instansi']) . '%');
    }

    if (!empty($filters['status'])) {
        $query->where('status', $filters['status']);
    }

    // ✅ Filter tahun berdasarkan tanggal_mulai
    if (!empty($filters['tahun'])) {
        $query->whereYear('tanggal_mulai', $filters['tahun']);
    }

    $magang = $query->get();

    $tahunList = Magang::selectRaw('YEAR(tanggal_mulai) as tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

    return view('admin.edit-index', compact('magang', 'bidang', 'filters', 'tahunList'));
}

    /**
     * Form edit mahasiswa magang
     */
    public function edit($id)
{
    $magang = Magang::findOrFail($id);
    $bidang = Bidang::all();

    // ambil filter dari session
    $filters = session('edit_filters', []);

    return view('admin.edit-form', compact('magang', 'bidang', 'filters'));
}


    /**
     * Proses update data mahasiswa magang
     */
    public function update(Request $request, $id)
{
    // Ambil data berdasarkan ID
    $magang = Magang::findOrFail($id);

    // Validasi input
    $validated = $request->validate([
        'nama_lengkap'        => 'required|string|max:150',
        'asal_instansi'       => 'nullable|string|max:100',
        'program_studi'       => 'nullable|string|max:100',
        'tingkat'             => 'nullable|in:SMA/K,D3,D4,S1,S2',
        'nomor_induk'         => 'nullable|digits_between:5,20|unique:tbl_anak_pkl,nomor_induk,' . $magang->id,
        'telepon'              => 'nullable|string|max:20',
        'jenis_kelamin'       => 'nullable|in:Laki-laki,Perempuan',
        'alamat_domisili'     => 'nullable|string',
        'tanggal_mulai'       => 'nullable|date',
        'tanggal_selesai'     => 'nullable|date|after_or_equal:tanggal_mulai',
        'unit_penempatan'     => 'nullable|exists:tbl_bidang,id',
        'pembimbing_instansi' => 'nullable|string|max:150',
        'pembimbing_lapangan' => 'nullable|string|max:150',
        'status'              => 'required|in:Aktif,Selesai,Diberhentikan',
    ],
    [
        'nomor_induk.unique' => 'NIM sudah terdaftar, silakan gunakan NIM lain.',
        'nomor_induk.digits_between' => 'NIM harus berupa angka minimal 5 digit.',
    ]);

    $magang->update($validated);

    // ambil filter dari session
    $filters = session('edit_filters', []);

    return redirect()
        ->route('admin.edit.index', $filters)
        ->with('sweetalert', [
        'icon'  => 'success',
        'title' => 'Berhasil!',
        'text'  => 'Data magang berhasil diperbarui!',
        ]);
    }

public function destroy($id)
{
    $magang = Magang::findOrFail($id);
    $magang->delete();

    return redirect()
    ->to(url()->previous())
    ->with('sweetalert', [
        'icon'  => 'success',
        'title' => 'Berhasil!',
        'text'  => 'Data berhasil dihapus!',
    ]);
}
}