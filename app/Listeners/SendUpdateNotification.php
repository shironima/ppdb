<?php

namespace App\Listeners;

use App\Events\RegistrationUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminUpdateNotificationMail;
use App\Mail\SiswaUpdateNotificationMail;
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

        // Kirim email ke admin
        $adminEmail = 'gabrielahensky.dev@gmail.com'; // email admin yang mau dikirimi email notifikasi
        Mail::to($adminEmail)->send(new AdminUpdateNotificationMail($user));
    }

}
