<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnakPkl extends Model
{
    protected $table = 'tbl_anak_pkl';

    protected $fillable = [
        'user_id',
        'bidang_id',
        'nama_lengkap',
        'nomor_induk',
        'asal_instansi',
        'program_studi',
        'tingkat',
        'telepon',
        'jenis_kelamin',
        'alamat_domisili',
        'tanggal_mulai',
        'tanggal_selesai',
        'pembimbing_instansi',
        'pembimbing_lapangan',
        'status',
    ];

    /*
    |--------------------------------
    | RELATIONSHIPS
    |--------------------------------
    */

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi ke bidang
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }
}