<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokPiket extends Model
{
    // ✅ PERBAIKAN: Sesuaikan dengan nama kolom di database
    protected $fillable = ['nama_kelompok', 'anggota']; // Ubah dari 'nama' ke 'nama_kelompok'

    protected $casts = [
        'anggota' => 'array',
    ];

    /**
     * Relasi ke JadwalPiket
     */
    public function jadwalPikets()
    {
        return $this->hasMany(JadwalPiket::class);
    }
}