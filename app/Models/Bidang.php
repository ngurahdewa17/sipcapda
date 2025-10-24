<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;
    protected $fillable = ['kode_bidang', 'unit_organisasi','periode_laporan'];

    public function programs()
    {
        return $this->hasMany(Program::class, 'program_id');
    }

}
