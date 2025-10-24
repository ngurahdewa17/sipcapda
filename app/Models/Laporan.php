<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [ 'sub_kegiatan_id', 'user_id', 'periode','realisasi_anggaran','realisasi_koefisien', 'date','status'];
 

    public function users()
    {
        // return $this->hasOne(Laporan::class, 'user_id');
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function subkegiatans()
    {
        return $this->belongsTo(Subkegiatan::class, 'sub_kegiatan_id', 'id');
    }

}
