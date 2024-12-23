<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
        'order_id',
        'snap_token',
        'transaction_status',
        'gross_amount',
        'payment_data',
        'calon_siswa_id',
        'status',
    ];

    // Relasi dengan model CalonSiswa
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }

    // Fungsi untuk memeriksa apakah pembayaran telah diverifikasi
    public function isVerified()
    {
        return $this->status === 'verified';
    }
}
