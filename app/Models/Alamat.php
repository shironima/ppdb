<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $table = 'alamat';

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'alamat_lengkap', 
        'rt',
        'rw',
        'kelurahan', 
        'kecamatan', 
        'kota_kabupaten', 
        'provinsi', 
        'kode_pos', 
        'tinggal_dengan',
    ];

    // Relasi ke model CalonSiswa (One to Many)
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'calon_siswa_id');
    }

    // Validasi data untuk kolom tinggal_dengan untuk memastikan bahwa 'tinggal_dengan' adalah salah satu pilihan yang valid
    public static $validTinggalDengan = [
        'Orang tua', 
        'Wali/famili', 
        'Asrama/panti', 
        'Lainnya'
    ];

    // Metode untuk memvalidasi kolom tinggal_dengan
    public function validateTinggalDengan()
    {
        return in_array($this->tinggal_dengan, self::$validTinggalDengan);
    }
}

