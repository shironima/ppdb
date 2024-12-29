<?php

namespace App\Listeners;

use App\Events\RegistrationSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Mail\SiswaNotificationMail;
use App\Mail\AdminNotificationMail;
use Illuminate\Support\Facades\Mail;


class SendRegistrationNotification
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
    public function handle(RegistrationSubmitted $event)
    {
        $registration = $event->registration;
        $user = $registration->calonSiswa->user;

        // Kirim email ke calon siswa
        if ($user->notificationContact->email) {
            Mail::to($user->notificationContact->email)->send(new SiswaNotificationMail($user));
        }

        // Kirim email ke admin
        $adminEmail = 'gabrielahensky.dev@gmail.com'; // email admin
        Mail::to($adminEmail)->send(new AdminNotificationMail($user));
    }
}
