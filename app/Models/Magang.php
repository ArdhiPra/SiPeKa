<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;

    // Nama tabel sebenarnya di database
    protected $table = 'tbl_anak_pkl';
    
    protected $casts = [
    'tanggal_mulai' => 'date',
    'tanggal_selesai' => 'date',
    ];

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'user_id',
        'bidang_id',
        'nama_lengkap',
        'nomor_induk',
        'asal_instansi',
        'program_studi',
        'tingkat',
        'no_hp',
        'jenis_kelamin',
        'alamat_domisili',
        'tanggal_mulai',
        'tanggal_selesai',
        'pembimbing_instansi',
        'pembimbing_lapangan',
        'status',
    ];

    protected $attributes = [
        'status' => 'Aktif',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }
    
}
