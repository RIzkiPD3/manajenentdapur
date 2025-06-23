<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kelompok_pikets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelompok');
            $table->integer('urutan')->unique(); // ✅ Kolom dan constraint langsung
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelompok_pikets');
    }
};
