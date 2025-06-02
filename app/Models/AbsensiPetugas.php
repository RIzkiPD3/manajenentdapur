<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiPetugas extends Model
{
    protected $fillable = [
        'sesi_absensi_id',
        'kelompok_piket_id',
        'nama_petugas',
        'status_hadir',
        'waktu_isi'
    ];

    protected $casts = [
        'status_hadir' => 'boolean',
        'waktu_isi' => 'datetime',
    ];
}

