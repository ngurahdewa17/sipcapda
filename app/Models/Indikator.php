<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;

    protected $fillable = ['subkegiatan_id', 'nama_indikator', 'tahun_indikator'];
    public function subkegiatans()
    {
        return $this->belongsTo(Subkegiatan::class);
    }

    public function laporans()
    {
        return $this->hasOne(Laporan::class);
    }

}
