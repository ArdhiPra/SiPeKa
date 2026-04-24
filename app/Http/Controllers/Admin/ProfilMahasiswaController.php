<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use Illuminate\Http\Request;

class ProfilMahasiswaController extends Controller
{
    public function show($id)
    {
        $mahasiswa = Magang::findOrFail($id);

        return view('admin.profil-mahasiswa', compact('mahasiswa'));
    }
}
