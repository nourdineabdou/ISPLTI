<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BachelierEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    //

    public function build()
    {
        return $this->subject('Message de l\'ISPTLI')
                    ->view('emails.contact' )
                    ->with([
                    'name'    => $this->data['name'] ?? null,
                    'email'   => $this->data['email'] ?? null,
                    'content' => $this->data['content'] ?? null,
                ]);
    }
}
