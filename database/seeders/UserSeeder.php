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
        // Menggunakan updateOrCreate untuk mencegah duplikasi
        User::updateOrCreate(
            ['email' => 'admin@pondok.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );

        User::updateOrCreate(
            ['email' => 'petugas@pondok.com'],
            [
                'name' => 'Petugas',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas'
            ]
        );

        User::updateOrCreate(
            ['email' => 'angkatan1@pondok.com'],
            [
                'name' => 'Angkatan 1',
                'password' => Hash::make('angkatan123'),
                'role' => 'angkatan'
            ]
        );

        User::updateOrCreate(
            ['email' => 'angkatan2@pondok.com'],
            [
                'name' => 'Angkatan 2',
                'password' => Hash::make('angkatan123'),
                'role' => 'angkatan'
            ]
        );
    }
}