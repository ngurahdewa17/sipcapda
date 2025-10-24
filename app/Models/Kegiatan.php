<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $fillable = ['program_id', 'kode_kegiatan','nama_kegiatan','indikator_kegiatan','tahun_kegiatan','anggaran_kegiatan','bulan','koefisien_kegiatan','satuan_kegiatan'];
    public function programs()
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }
    public function subkegiatans()
    {
        // return $this->hasMany(Subkegiatan::class, 'subkegiatan_id');
        return $this->hasMany(Subkegiatan::class, 'kegiatan_id', 'id');
    }
}
