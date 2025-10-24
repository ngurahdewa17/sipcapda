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
        Schema::create('subkegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->nullable()->constrained('kegiatans')->onDelete('cascade');
            $table->string('kode_sub_kegiatan');
            $table->string('nama_sub_kegiatan');
            $table->string('indikator_sub_kegiatan');
            $table->string('tahun_sub_kegiatan');
            $table->string('anggaran_sub_kegiatan');
            $table->string('koefisien_sub_kegiatan');
            $table->string('satuan_sub_kegiatan'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subkegiatans', function (Blueprint $table) {
            Schema::dropIfExists('subkegiatans');
            $table->dropForeign(['kegiatan_id']);
            $table->dropColumn('kegiatan_id');
        });
    }
};
