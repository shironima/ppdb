<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan'; // Nama tabel di database
    protected $fillable = [
        'user_id',
        'pertanyaan',
        'jawaban',
        'status',
    ];

    // Relasi ke user = calon siswa
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
