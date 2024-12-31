<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Determine if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Determine if the user is a siswa.
     *
     * @return bool
     */
    public function isSiswa()
    {
        return $this->role === 'siswa';
    }

    /**
     * Get the calon siswa associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function calonSiswa()
    {
        return $this->hasOne(CalonSiswa::class, 'user_id');
    }

    public function alamat()
    {
        return $this->hasOne(Alamat::class, 'user_id');
    }

    public function dataRinci()
    {
        return $this->hasOne(DataRinci::class, 'user_id');
    }

    public function dataOrangTua()
    {
        return $this->hasOne(DataOrangTua::class, 'user_id');
    }
    
    public function registration()
    {
        return $this->hasOne(Registration::class, 'calon_siswa_id', 'id');
    }

    public function notificationContact()
    {
        return $this->hasOne(NotificationContact::class);
    }
}
