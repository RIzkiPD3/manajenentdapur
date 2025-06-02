<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    User::create([
        'name' => 'Admin',
        'email' => 'admin@pondok.com',
        'password' => Hash::make('admin123'),
        'role' => 'admin'
    ]);
    User::create([
        'name' => 'Petugas',
        'email' => 'petugas@pondok.com',
        'password' => Hash::make('petugas123'),
        'role' => 'petugas'
    ]);
    User::create([
        'name' => 'Angkatan 1',
        'email' => 'angkatan1@pondok.com',
        'password' => Hash::make('angkatan123'),
        'role' => 'angkatan'
    ]);
    User::create([
        'name' => 'Angkatan 2',
        'email' => 'angkatan2@pondok.com',
        'password' => Hash::make('angkatan123'),
        'role' => 'angkatan'
    ]);
}
}
