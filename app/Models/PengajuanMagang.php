<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanMagang extends Model
{
    use HasFactory;

    protected $table = 'tbl_pengajuan_magang';

    protected $fillable = [
        'user_id',
        'bidang_id',
        'nama',
        'nomor_induk',
        'tingkat',
        'program_studi',
        'file_pengajuan',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'alasan_tolak',
        'is_read',
    ];

    // 🔗 RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 RELASI KE BIDANG
    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }
}