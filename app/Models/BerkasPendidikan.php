<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasPendidikan extends Model
{
    // Tentukan relasi dengan CalonSiswa (One to Many)
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'calon_siswa_id');
    }
}
