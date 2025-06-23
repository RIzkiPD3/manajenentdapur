<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPiket extends Model
{
    protected $fillable = [
        'tanggal',
        'hari',
        'kelompok_piket_id', // ✅ PERBAIKAN: Sesuaikan dengan migration
        'menu_id'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    /**
     * Relasi ke KelompokPiket - KONSISTEN dengan migration
     */
    public function kelompok()
    {
        return $this->belongsTo(KelompokPiket::class, 'kelompok_piket_id');
    }

    /**
     * Relasi ke Menu
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    /**
     * Scope untuk jadwal hari ini
     */
    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal', today());
    }

    /**
     * Scope untuk jadwal minggu ini
     */
    public function scopeMingguIni($query)
    {
        return $query->whereBetween('tanggal', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }
}