<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\SiswaStatusChangeNotificationMail;
use App\Events\RegistrationStatusChanged;
use App\Services\FonnteService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendStatusChangeNotification
{
    protected $fonnteService;

    /**
     * Create the event listener.
     */
    public function __construct(FonnteService $fonnteService)
    {
        $this->fonnteService = $fonnteService;
    }

    /**
     * Handle the event.
     */
    public function handle(RegistrationStatusChanged $event): void
    {
        $registration = $event->registration;
        $user = $registration->calonSiswa->user;

        // Kirim email ke calon siswa
        if ($user->notificationContact->email) {
            Mail::to($user->notificationContact->email)->send(new SiswaStatusChangeNotificationMail($user, $registration));
        }

        // Kirim WhatsApp ke calon siswa 
        if ($user->notificationContact->whatsapp) {
            // Membuat pesan berdasarkan status pendaftaran
            $message = "*Halo {$user->calonSiswa->nama_lengkap}* 👋\n\n";
            
            if ($registration->status === 'accepted') {
                $message .= "🎉 *Selamat!* 🎉\n"
                          . "Kamu diterima di SMAK Santo Bonaventura! 🏫✨\n\n";
            }
        
            $message .= "Status pendaftaran Anda telah berubah menjadi: *{$registration->status}*.\n\n"
                     . "*Komentar*: " . (isset($registration->komentar) ? $registration->komentar : 'Tidak ada komentar dari admin.') . "\n\n"
                     . "Silahkan cek selengkapnya di halaman dashboard."
                     . "Terima kasih atas perhatian Anda. 😃\n\n"
                     . "_Jangan ragu untuk menghubungi kami jika Anda membutuhkan bantuan lebih lanjut._";
        
            // Mengirim pesan WhatsApp
            $this->fonnteService->sendWhatsappMessage($user->notificationContact->whatsapp, $message);
        }
        
    }

}
