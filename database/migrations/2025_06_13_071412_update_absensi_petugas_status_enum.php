<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('absensi_petugas', function (Blueprint $table) {
            // Hapus kolom lama yang tidak digunakan
            $table->dropColumn(['status_hadir', 'waktu_isi']);

            // Tambah kolom status dengan enum
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alpha'])->default('alpha');

            // Tambah kolom daftar_hadir jika dibutuhkan untuk data tambahan
            $table->json('daftar_hadir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensi_petugas', function (Blueprint $table) {
            $table->dropColumn(['status', 'daftar_hadir']);
            $table->boolean('status_hadir')->default(false);
            $table->timestamp('waktu_isi')->nullable();
        });
    }
};