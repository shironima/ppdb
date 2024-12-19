<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataOrangTua extends Model
{
    protected $table = 'data_orang_tua';

    protected $fillable = [
        'user_id',
        'calon_siswa_id',
        'nama_ayah',
        'nik_ayah',
        'tahun_lahir_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nomor_hp_ayah',
        'nama_ibu',
        'nik_ibu',
        'tahun_lahir_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'nomor_hp_ibu',
    ];

    /**
     * Relasi dengan model CalonSiswa (One to One).
     */
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }

    /**
     * Relasi dengan model User (One to One).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
