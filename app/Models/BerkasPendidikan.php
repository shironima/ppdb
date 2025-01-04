<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BerkasPendidikan extends Model
{
    use HasFactory;
    protected $table = 'berkas_pendidikan';
    protected $fillable = [
        'user_id',
        'calon_siswa_id',
        'ijazah',
        'skhun',
        'raport',
        'kartu_keluarga',
        'status',
        'komentar',
    ];

    public function getFileUrl($field)
    {
        return Storage::disk('public')->url($this->$field);
    }
    
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
