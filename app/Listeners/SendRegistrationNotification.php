<?php

namespace App\Listeners;

use App\Events\RegistrationSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Mail\SiswaNotificationMail;
use App\Mail\AdminNotificationMail;
use Illuminate\Support\Facades\Mail;

use App\Models\AdminPPDB;


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

        // Kirim email ke semua admin
        $admins = AdminPpdb::all();
        foreach ($admins as $admin) {
            // Pastikan email admin ada
            if ($admin->email) {
                Mail::to($admin->email)->send(new AdminNotificationMail($user));
            }
        }
    }

}
