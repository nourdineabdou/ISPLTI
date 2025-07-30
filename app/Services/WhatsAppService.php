<?php

namespace App\Services;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;

class WhatsAppService
{
    protected Client $twilio;

    /**
     * @throws ConfigurationException
     */
    public function __construct()
    {
        $this->twilio = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
    }

    public function sendMessage(string $to, string $message): void
    {
        $this->twilio->messages->create(
            "whatsapp:$to", // To WhatsApp number
            [
                'from' => config('services.twilio.whatsapp_from'), // From WhatsApp number
                'body' => $message,
            ]
        );
    }
}

