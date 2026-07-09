<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password_clair;
    public $role;

    // On récupère l'utilisateur, son mot de passe non crypté et son rôle
    public function __construct($user, $password_clair, $role)
    {
        $this->user = $user;
        $this->password_clair = $password_clair;
        $this->role = $role;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenue sur l\'ERP - Vos identifiants de connexion',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.welcome', // Le template visuel
        );
    }
}
