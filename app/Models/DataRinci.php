<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataRinci extends Model
{
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'calon_siswa_id');
    }
}
