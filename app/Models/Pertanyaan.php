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

    /**
     * Relasi ke siswa (role siswa di tabel calon_siswa).
     */
    public function siswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'user_id');
    }

    /**
     * Relasi ke admin (role admin di tabel admin_ppdb).
     */
    public function admin()
    {
        return $this->belongsTo(AdminPPDB::class, 'user_id');
    }

    /**
     * Relasi ke pengguna (tabel users).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
