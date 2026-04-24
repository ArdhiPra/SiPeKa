<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{

    protected $table = 'tbl_profil';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nomor_induk',
        'asal_instansi',
        'program_studi',
        'tingkat',
        'telepon',
        'jenis_kelamin',
        'alamat_domisili',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}