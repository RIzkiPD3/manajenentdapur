<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiAbsensi extends Model
{
    protected $fillable = ['nama_sesi', 'waktu_mulai', 'waktu_selesai'];
}
