<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Totallaporan extends Model
{
    use HasFactory;

    protected $fillable = [ 'jml_program', 'jml_kegiatan', 'jml_subkegiatan','bulan_totallaporan','tahun_totallaporan', 'anggaran_totallaporan','realisasianggaran_totallaporan','capaian_realisasi','capaian_koefisien','rata_rata_capaian'];
 

  
}
