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
        Schema::table('subkegiatans', function (Blueprint $table) {
            // ubah kolom menjadi TEXT agar bisa menampung teks panjang
            $table->text('nama_sub_kegiatan')->change();
            $table->text('indikator_sub_kegiatan')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
         Schema::table('subkegiatans', function (Blueprint $table) {
            // kembalikan ke string(255) kalau di-rollback
            $table->string('nama_sub_kegiatan', 255)->change();
            $table->string('indikator_sub_kegiatan', 255)->change();
        });
    }
};
