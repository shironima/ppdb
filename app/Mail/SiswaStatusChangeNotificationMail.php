<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SiswaStatusChangeNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $registration;
    public $statusMessage;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $registration)
    {
        $this->user = $user;
        $this->registration = $registration;

        // Tentukan pesan status berdasarkan status pendaftaran
        if ($registration->status === 'Accepted') {
            $this->statusMessage = 'SELAMAT! ANDA DITERIMA SEBAGAI SISWA SMAK SANTO BONAVENTURA';
        } else {
            $this->statusMessage = 'Status pendaftaran Anda telah diperbarui.';
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Perubahan Status Pendaftaran Anda',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.siswa.status-change',
            with: [
                'user' => $this->user,
                'registration' => $this->registration,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
