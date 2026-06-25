<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    public function sendMessage(string $phone, string $message): bool
    {
        $apiKey = config('services.whatsapp.api_key');
        $apiUrl = config('services.whatsapp.api_url');

        if (!$apiKey || !$apiUrl) {
            return false;
        }

        try {
            $response = Http::timeout(10)->post($apiUrl, [
                'phone'   => $phone,
                'message' => $message,
                'api_key' => $apiKey,
            ]);

            return $response->successful();
        } catch (\Throwable $e) {
            Log::error('WhatsApp send failed', [
                'phone'   => $phone,
                'error'   => $e->getMessage(),
            ]);

            return false;
        }
    }

    public function sendInquiryNotification(string $phone, string $refNumber, string $patientName): bool
    {
        $message = "New inquiry received!\n"
            . "Reference: {$refNumber}\n"
            . "Patient: {$patientName}\n"
            . "View: " . url("/admin/inquiries");

        return $this->sendMessage($phone, $message);
    }
}
