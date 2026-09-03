<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NouveauCompteClient extends Mailable
{
    use Queueable, SerializesModels;

    public $nom;
    public $emailClient;
    public $motDePasse;

    /**
     * Create a new message instance.
     */
    public function __construct(string $nom, string $emailClient, string $motDePasse)
    {
        $this->nom = $nom;
        $this->emailClient = $emailClient;
        $this->motDePasse = $motDePasse;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Votre espace client GIES-CI')
            ->markdown('emails.nouveau-compte-client');
    }
}
