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
        // Mengirim email ke user
        Mail::to($event->registration->calonSiswa->email)->send(new SiswaNotificationMail($event->registration));

        // Mengirim email ke admin
        Mail::to('admin@example.com')->send(new AdminNotificationMail($event->registration));
    }
}
