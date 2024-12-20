<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataRinci extends Model
{
    protected $table = 'data_rinci';

    protected $fillable = [
        'user_id',
        'calon_siswa_id',
        'tinggi_badan',        
        'berat_badan',         
        'anak_ke',             
        'jumlah_saudara',      
        'asal_sekolah',        
        'tahun_lulus',         
        'alamat_sekolah_asal', 
        'status',
    ];

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
