<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
        'status',
        'komentar',
    ];
    public function getTanggalLahirAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y');
    }

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

    public function isCompleted()
    {
        return $this->alamat && $this->dataOrangTua && $this->dataRinci && $this->berkasPendidikan;
    }

    public function registration()
    {
        return $this->hasOne(Registration::class);
    }

    public function notificationContact()
    {
        return $this->hasOne(NotificationContact::class);
    }

}
