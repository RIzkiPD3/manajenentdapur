<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokPiket extends Model
{
    protected $fillable = ['nama_kelompok', 'anggota'];

    protected $casts = [
        'anggota' => 'array',
    ];
}