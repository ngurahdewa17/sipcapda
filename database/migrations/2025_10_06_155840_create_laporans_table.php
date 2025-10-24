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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_kegiatan_id')->nullable()
                  ->constrained('subkegiatans')
                  ->onDelete('cascade'); // jika user dihapus, profil ikut terhapus
            $table->foreignId('user_id')->nullable()
                        ->constrained('users')
                        ->onDelete('cascade');
            $table->string('periode');
            $table->string('realisasi_anggaran');
            $table->string('realisasi_koefisien');
            $table->date('date')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            Schema::dropIfExists('laporans');
            $table->dropForeign(['sub_kegiatan_id']);
            $table->dropColumn('sub_kegiatan_id');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
