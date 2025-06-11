<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestNampan extends Model
{
    protected $fillable = [
        'user_id',
        'jumlah_nampan',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelompok()
    {
        return $this->belongsTo(JadwalPiket::class, 'kelompok_id');
    }
}