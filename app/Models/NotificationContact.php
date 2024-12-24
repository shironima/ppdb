<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationContact extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang digunakan
    protected $table = 'notification_contact';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'user_id',
        'calon_siswa_id',
        'email',
        'whatsapp',
    ];

    // Relasi dengan model User (jika ada)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model CalonSiswa (jika ada)
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }
}
