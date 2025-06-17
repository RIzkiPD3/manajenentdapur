<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiPetugas extends Model
{
    protected $fillable = [
        'kelompok_piket_id',
        'sesi_absensi_id',
        'nama_petugas',
        'status',
        'daftar_hadir',
    ];

    protected $casts = [
        'daftar_hadir' => 'array',
    ];

    // Konstanta untuk status
    const STATUS_HADIR = 'hadir';
    const STATUS_SAKIT = 'sakit';
    const STATUS_IZIN = 'izin';
    const STATUS_ALPHA = 'alpha';

    // Method untuk mendapatkan semua status yang tersedia
    public static function getAvailableStatuses()
    {
        return [
            self::STATUS_HADIR => 'Hadir',
            self::STATUS_SAKIT => 'Sakit',
            self::STATUS_IZIN => 'Izin',
            self::STATUS_ALPHA => 'Alpha',
        ];
    }

    // Method untuk mendapatkan label status
    public function getStatusLabelAttribute()
    {
        $statuses = self::getAvailableStatuses();
        return $statuses[$this->status] ?? 'Unknown';
    }

    // Method untuk mendapatkan badge class untuk styling
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            self::STATUS_HADIR => 'bg-success',
            self::STATUS_SAKIT => 'bg-warning',
            self::STATUS_IZIN => 'bg-info',
            self::STATUS_ALPHA => 'bg-danger',
            default => 'bg-secondary'
        };
    }

    // Scope untuk filter berdasarkan status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope untuk mendapatkan yang hadir
    public function scopeHadir($query)
    {
        return $query->where('status', self::STATUS_HADIR);
    }

    // Scope untuk mendapatkan yang tidak hadir
    public function scopeTidakHadir($query)
    {
        return $query->whereIn('status', [self::STATUS_SAKIT, self::STATUS_IZIN, self::STATUS_ALPHA]);
    }

    public function kelompok()
    {
        return $this->belongsTo(KelompokPiket::class, 'kelompok_piket_id');
    }

    public function sesi()
    {
        return $this->belongsTo(SesiAbsensi::class, 'sesi_absensi_id');
    }
}