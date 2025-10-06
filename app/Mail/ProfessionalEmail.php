<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProfessionalEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $messageText;
    public $photoUrl;
    public $institutionName;
    public $actionUrl;
    public $actionText;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name = null, string $messageText = null, string $photoUrl = null, string $institutionName = null, string $actionUrl = null, string $actionText = null)
    {
        $this->name = $name;
        $this->messageText = $messageText;
        $this->photoUrl = $photoUrl;
        $this->institutionName = $institutionName;
        $this->actionUrl = $actionUrl;
        $this->actionText = $actionText;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->institutionName ? "Message de {$this->institutionName}" : 'Message important')
                    ->view('emails.professional')
                    ->with([
                        'name' => $this->name,
                        'message' => $this->messageText,
                        'photoUrl' => $this->photoUrl,
                        'institutionName' => $this->institutionName,
                        'actionUrl' => $this->actionUrl,
                        'actionText' => $this->actionText,
                    ]);
    }
}
