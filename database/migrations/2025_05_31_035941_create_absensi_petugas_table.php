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
        Schema::create('absensi_petugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesi_absensi_id')->constrained()->onDelete('cascade');
            $table->foreignId('kelompok_piket_id')->constrained()->onDelete('cascade');
            $table->string('nama_petugas');
            $table->boolean('status_hadir')->default(false);
            $table->timestamp('waktu_isi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_petugas');
    }
};
