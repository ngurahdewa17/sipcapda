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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->nullable()->constrained('programs')->onDelete('cascade');
            $table->string('kode_kegiatan');
            $table->string('nama_kegiatan');
            $table->string('indikator_kegiatan');
            $table->string('tahun_kegiatan');
            $table->string('anggaran_kegiatan');
            $table->string('koefisien_kegiatan');
            $table->string('satuan_kegiatan'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            Schema::dropIfExists('kegiatans');
            $table->dropForeign(['program_id']);
            $table->dropColumn('program_id');
        });
    }
};
