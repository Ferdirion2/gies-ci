<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $messageData;

    public function __construct(array $messageData)
    {
        $this->messageData = $messageData;
    }

    public function build()
    {
        $subject = "Nouveau message de contact: " . ($this->messageData['sujet'] ?? 'Sans sujet');

        $mail = $this->subject($subject)
            ->view('emails.message-contact')
            ->with(['data' => $this->messageData]);

        // Ensure replies go to the visitor's email
        if (! empty($this->messageData['email'])) {
            $mail->replyTo($this->messageData['email'], $this->messageData['nom'] ?? null);
        }

        return $mail;
    }
}
