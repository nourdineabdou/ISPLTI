<?php

namespace App\Mail;

use App\Models\CandidatureMaster;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CandidatureAccepteeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public CandidatureMaster $candidature) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('candidature.email_acceptee_sujet', ['numero' => $this->candidature->numero_candidature]),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.candidature-acceptee',
            with: [
                'candidature' => $this->candidature,
                'url' => route('candidature.connexion'),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
