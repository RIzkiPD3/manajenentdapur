<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Angkatan extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_angkatan',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status_aktif' => 'boolean',
            'tahun_angkatan' => 'integer'
        ];
    }

    /**
     * Scope: Only active angkatan
     */
    public function scopeActive($query)
    {
        return $query->where('status_aktif', true);
    }

    /**
     * Scope: Filter by year
     */
    public function scopeByYear($query, $year)
    {
        return $query->where('tahun_angkatan', $year);
    }

    /**
     * Check if angkatan is active
     */
    public function isActive()
    {
        return $this->status_aktif;
    }

    /**
     * Get formatted nama angkatan with year
     */
    public function getFormattedNameAttribute()
    {
        return $this->nama_angkatan . ' (' . $this->tahun_angkatan . ')';
    }

    /**
     * Get total kelompok count
     */
    public function getTotalKelompokAttribute()
    {
        return $this->kelompokPiket()->count();
    }

    /**
     * Get active kelompok count
     */
    public function getActiveKelompokAttribute()
    {
        return $this->kelompokPiket()->where('status_aktif', true)->count();
    }
}
