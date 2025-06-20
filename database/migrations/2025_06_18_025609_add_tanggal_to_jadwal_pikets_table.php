<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
        {
            Schema::table('jadwal_pikets', function (Blueprint $table) {
                $table->date('tanggal')->after('hari');
            });
        }

        public function down()
        {
            Schema::table('jadwal_pikets', function (Blueprint $table) {
                $table->dropColumn('tanggal');
            });
        }

};
