<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestNampan extends Model
{
    protected $fillable = [
        'user_id',
        'kelompok_piket_id',
        'jumlah_nampan',
        'tanggal'
    ];
}

