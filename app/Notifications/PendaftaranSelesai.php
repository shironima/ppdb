<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PendaftaranSelesai extends Notification
{
    use Queueable;

    protected $pendaftar;

    /**
     * Create a new notification instance.
     *
     * @param object $pendaftar Data pendaftar yang akan disertakan dalam email.
     */
    public function __construct($pendaftar)
    {
        $this->pendaftar = $pendaftar;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pendaftaran Berhasil')
            ->greeting('Halo, ' . $this->pendaftar->nama . '!')
            ->line('Terima kasih telah mendaftar di SMAK Santo Bonaventura.')
            ->line('Kami telah menerima data pendaftaran Anda.')
            ->line('Detail Pendaftaran:')
            ->line('Nama: ' . $this->pendaftar->nama)
            ->line('Email: ' . $this->pendaftar->email)
            ->line('Nomor Pendaftaran: ' . $this->pendaftar->nomor_pendaftaran)
            ->action('Lihat Status Pendaftaran', url('/pendaftaran/status/' . $this->pendaftar->id))
            ->line('Jika ada pertanyaan, silakan hubungi kami.')
            ->line('Terima kasih telah memilih SMAK Santo Bonaventura!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'pendaftar_id' => $this->pendaftar->id,
            'nama' => $this->pendaftar->nama,
        ];
    }
}
