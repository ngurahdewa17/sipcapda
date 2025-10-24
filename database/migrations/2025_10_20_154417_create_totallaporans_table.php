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
        Schema::create('totallaporans', function (Blueprint $table) {
            $table->id();
            $table->string('jml_program');
            $table->string('jml_kegiatan');
            $table->string('jml_subkegiatan');
            $table->string('bulan_totallaporan');
            $table->string('tahun_totallaporan');
            $table->string('anggaran_totallaporan');
            $table->string('realisasianggaran_totallaporan');
            $table->string('capaian_realisasi');
            $table->string('capaian_koefisien');
            $table->string('rata_rata_capaian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('totallaporans');
    }
};
