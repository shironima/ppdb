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
        'notification_contact_id',
        'status',
        'komentar',
    ];

    /**
     * Menggunakan enum untuk status
     */
    protected $casts = [
        'status' => 'string',
    ];

    const STATUS_SUBMITTED = 'submitted';
    const STATUS_UPDATED = 'updated';
    const STATUS_VERIFIED = 'verified';
    const STATUS_REQUIRES_REVISION = 'requires_revision';

    /**
     * Mendefinisikan enum untuk status
     */
    public static function getStatusOptions()
    {
        return [
            self::STATUS_SUBMITTED => 'Submitted',
            self::STATUS_UPDATED => 'Updated',
            self::STATUS_VERIFIED => 'Verified',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        
        // Generate UUID jika belum ada ID saat create
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });

        static::deleting(function ($registration) {
            // Hapus relasi terkait, kecuali notification_contact
            if ($registration->calonSiswa) {
                $registration->calonSiswa->delete();
            }

            if ($registration->alamat) {
                $registration->alamat->delete();
            }

            if ($registration->dataRinci) {
                $registration->dataRinci->delete();
            }

            if ($registration->dataOrangTua) {
                $registration->dataOrangTua->delete();
            }

            if ($registration->berkasPendidikan) {
                $registration->berkasPendidikan->delete();
            }

            // Abaikan penghapusan notificationContact
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

    public function notificationContact()
    {
        return $this->belongsTo(NotificationContact::class, 'notification_contact_id');
    }
}
