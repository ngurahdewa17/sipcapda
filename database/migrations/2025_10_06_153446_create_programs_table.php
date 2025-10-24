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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidang_id')->nullable()->constrained('bidangs')->onDelete('cascade');
            $table->string('kode_program');
            $table->string('nama_program');
            $table->string('indikator_program');
            $table->string('tahun_program');
            $table->string('anggaran_program');
            $table->string('koefisien_program');
            $table->string('satuan_program'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            Schema::dropIfExists('programs');
            $table->dropForeign(['bidang_id']);
            $table->dropColumn('bidang_id');
        });
    }
};
