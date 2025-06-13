<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiPetugas extends Model
{
    protected $fillable = [
        'tanggal',
        'kelompok_piket_id',
        'sesi_absensi_id',
        'daftar_hadir',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'daftar_hadir' => 'array',
    ];

    public function kelompok()
    {
        return $this->belongsTo(KelompokPiket::class);
    }

    public function sesi()
    {
        return $this->belongsTo(SesiAbsensi::class, 'sesi_absensi_id');
    }
}
