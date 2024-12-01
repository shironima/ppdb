<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'calon_siswa';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'nisn',
        'no_kk',
        'nik',
        'no_hp',
    ];

    // Tentukan relasi dengan model User (One to One)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alamat()
    {
        return $this->hasOne(Alamat::class);
    }

    public function dataOrangTua()
    {
        return $this->hasOne(DataOrangTua::class);
    }

    public function dataRinci()
    {
        return $this->hasOne(DataRinci::class);
    }

    public function berkasPendidikan()
    {
        return $this->hasOne(BerkasPendidikan::class);
    }
}
