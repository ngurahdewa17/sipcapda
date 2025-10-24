<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = ['bidang_id', 'kode_program','nama_program','indikator_program','tahun_program','anggaran_program','koefisien_program','bulan','satuan_program'];
    public function bidangs()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }
    public function kegiatans()
    {
        // return $this->hasMany(Kegiatan::class, 'kegiatan_id');
        return $this->hasMany(Kegiatan::class, 'program_id', 'id');
    }
}
