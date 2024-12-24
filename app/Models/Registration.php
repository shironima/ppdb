<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Registration extends Model
{
    use HasFactory;

    public $incrementing = false; // Nonaktifkan auto increment untuk ID utama
    protected $keyType = 'string'; // ID menggunakan UUID, bukan integer

    protected $table = 'registration';

    protected $fillable = [
        'id',
        'calon_siswa_id',
        'alamat_id',
        'data_orang_tua_id',
        'data_rinci_id',
        'berkas_pendidikan_id',
        'payment_id',
    ];

    protected static function boot()
    {
        parent::boot();
        
        // Generate UUID jika belum ada ID saat create
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'calon_siswa_id');
    }

    // Relasi dengan model CalonSiswa (One to One)
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'calon_siswa_id', 'id');
    }

    // Relasi dengan model Alamat (One to One)
    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'alamat_id');
    }

    // Relasi dengan model DataOrangTua (One to One)
    public function dataOrangTua()
    {
        return $this->belongsTo(DataOrangTua::class, 'data_orang_tua_id');
    }

    // Relasi dengan model DataRinci (One to One)
    public function dataRinci()
    {
        return $this->belongsTo(DataRinci::class, 'data_rinci_id');
    }

    // Relasi dengan model BerkasPendidikan (One to One)
    public function berkasPendidikan()
    {
        return $this->belongsTo(BerkasPendidikan::class, 'berkas_pendidikan_id');
    }

    // Relasi dengan model Pembayaran (One to One)
    public function pembayaran()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function notificationContact()
    {
        return $this->belongsTo(NotificationContact::class, 'notification_contact_id');
    }
}
