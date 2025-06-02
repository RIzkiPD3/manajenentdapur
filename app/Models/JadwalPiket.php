<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KelompokPiket;

class JadwalPiket extends Model
{
    protected $fillable = ['kelompok_piket_id', 'tanggal'];

    public function kelompok()
    {
        return $this->belongsTo(KelompokPiket::class);
    }
}

