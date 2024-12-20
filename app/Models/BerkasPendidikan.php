<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasPendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'calon_siswa_id',
        'ijazah',
        'skhun',
        'raport',
        'kartu_keluarga',
        'status'
    ];

    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
