<?php

namespace App\Listeners;

use App\Events\RegistrationUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminUpdateNotificationMail;
use App\Mail\SiswaUpdateNotificationMail;
use App\Models\AdminPpdb;
use App\Models\Registration;
use Illuminate\Support\Facades\Log;

class SendUpdateNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RegistrationUpdated $event)
    {
        $registration = $event->registration;
        $user = $registration->calonSiswa->user;

        // Kirim email ke calon siswa
        $userEmail = $user->notificationContact->email ?? null;
        if ($userEmail) {
            Mail::to($userEmail)->send(new SiswaUpdateNotificationMail($user));
        }

        // Kirim email ke semua admin
        $admins = AdminPpdb::all();  // Ambil semua admin
        foreach ($admins as $admin) {
            // Pastikan email admin ada
            if ($admin->email) {
                Mail::to($admin->email)->send(new AdminUpdateNotificationMail($user));
            }
        }
    }

}
