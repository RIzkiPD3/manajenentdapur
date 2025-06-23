<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokPiket extends Model
{
    protected $fillable = [
        'nama_kelompok',
        'anggota',
        'urutan'
    ];

    protected $casts = [
        'anggota' => 'array',
    ];

    /**
     * Relasi ke JadwalPiket
     */
    public function jadwalPikets()
    {
        return $this->hasMany(JadwalPiket::class, 'kelompok_piket_id');
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

    // HAPUS accessor getNamaAttribute() karena bisa konflik dengan kolom database
}