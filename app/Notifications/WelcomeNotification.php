<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification
{
    use Queueable;

    public $password_clair;
    public $role;

    // On récupère le mot de passe et le rôle pour les envoyer à la vue
    public function __construct($password_clair, $role)
    {
        $this->password_clair = $password_clair;
        $this->role = $role;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Vos accès à la plateforme ERP 🎉')
            // C'est ICI la magie : on utilise markdown() pour que le design s'applique !
            ->markdown('emails.welcome', [
                'user' => $notifiable,
                'password_clair' => $this->password_clair,
                'role' => $this->role
            ]);
    }
}
