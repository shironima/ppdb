<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $table = 'alamat';

    protected $fillable = [
        'user_id',           
        'calon_siswa_id',    
        'alamat_lengkap',    
        'rt',               
        'rw',                
        'kelurahan',        
        'kecamatan',         
        'kota_kabupaten',    
        'provinsi',          
        'kode_pos',          
        'tinggal_dengan',    
        'status',    
        'komentar',       
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model CalonSiswa (One to Many)
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }
}
