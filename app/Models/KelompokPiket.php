<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokPiket extends Model
{
    protected $fillable = [
        'nama_kelompok',
        'anggota',
        'urutan' // ✅ SUDAH BENAR
    ];

    protected $casts = [
        'anggota' => 'array',
    ];

    /**
     * Relasi ke JadwalPiket - SESUAIKAN dengan field yang benar
     */
    public function jadwalPikets()
    {
        return $this->hasMany(JadwalPiket::class, 'kelompok_piket_id'); // ✅ FIXED
    }

    /**
     * Scope untuk ordering berdasarkan urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }

    /**
     * Get nama kelompok dengan format
     */
    public function getNamaFormattedAttribute()
    {
        return "Kelompok " . $this->nama_kelompok;
    }

    /**
     * ✅ Accessor untuk nama agar view bisa mengakses ->nama
     */
    public function getNamaAttribute()
    {
        return $this->nama_kelompok;
    }
}