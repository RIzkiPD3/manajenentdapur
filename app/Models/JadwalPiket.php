<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPiket extends Model
{
    protected $fillable = [
        'kelompok_piket_id',
        'hari'
    ];

    /**
     * Relasi ke KelompokPiket
     */
    public function kelompok()
    {
        return $this->belongsTo(KelompokPiket::class, 'kelompok_piket_id');
    }

    public function menu()
{
    return $this->belongsTo(Menu::class, 'menu_id');
}

}