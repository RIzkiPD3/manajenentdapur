<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['nama_menu', 'sesi', 'tanggal'];

    protected $casts = [
        'tanggal' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
};