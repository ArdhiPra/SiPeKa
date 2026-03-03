<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $table = 'tbl_bidang';

    protected $fillable = [
        'nama_bidang',
    ];

    /* ================= RELASI ================= */

    // Satu bidang punya banyak peserta PKL
    public function anakPkl()
    {
        return $this->hasMany(AnakPkl::class, 'bidang_id');
    }
}