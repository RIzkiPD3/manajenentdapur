<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KelompokPiket;

class JadwalPiket extends Model
{
    protected $fillable = ['kelompok_piket_id', 'tanggal'];

    // ✅ Perbaikan: Tambahkan foreign key yang benar
    public function kelompok()
    {
        return $this->belongsTo(KelompokPiket::class, 'kelompok_piket_id');
    }

    // ✅ Tambahan: Jika ada relasi ke menu, tambahkan ini
    // Uncomment jika ada tabel menu dan field menu_id di jadwal_piket
    /*
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    */
}