<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected $apiToken;

    public function __construct()
    {
        $this->apiToken = env('FONNTE_API_TOKEN');
    }

    public function sendWhatsappMessage($phoneNumber, $message)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->apiToken,
        ])->post('https://api.fonnte.com/send', [
            'target' => $phoneNumber,
            'message' => $message,
        ]);

        // Debug respons
        Log::info('Fonnte API Response', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        // Cek status API
        if ($response->json('status') === 'success') {
            Log::info('Pesan WhatsApp berhasil dikirim ke ' . $phoneNumber);
        } else {
            Log::error('Gagal mengirim pesan WhatsApp. Respons: ' . $response->body());
        }
    }
}
