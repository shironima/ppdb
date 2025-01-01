<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPPDB extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'admin_ppdb';

    protected $fillable = [
        'user_id',
        'email',
        'whatsapp',
    ];

    // Tentukan relasi dengan model User (One to One)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
