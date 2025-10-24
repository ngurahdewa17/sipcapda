<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkegiatan extends Model
{
    use HasFactory;
    protected $fillable = ['kegiatan_id', 'kode_sub_kegiatan','nama_sub_kegiatan','bulan','indikator_sub_kegiatan','tahun_sub_kegiatan','anggaran_sub_kegiatan','koefisien_sub_kegiatan','satuan_sub_kegiatan'];
    public function kegiatans()
    {
 		return $this->belongsTo(Kegiatan::class, 'kegiatan_id','id');
    } 

    public function laporans()
    {
        // return $this->hasOne(Laporan::class , 'laporan_id');
         return $this->hasOne(Laporan::class , 'sub_kegiatan_id','id');
    }
}
