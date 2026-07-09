<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    // On remplace la variable $token par $password pour que ce soit plus logique
    public $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // On construit l'e-mail avec la syntaxe Markdown native de Laravel
        return (new MailMessage)
            ->subject('Réinitialisation de votre mot de passe')

            // Le nom en gras grâce aux doubles astérisques **
            ->greeting('Bonjour **' . $notifiable->name . '**,')

            ->line('Une demande de réinitialisation de mot de passe a été effectuée pour votre compte sur la plateforme **ENSAM ERP**.')
            ->line('Conformément aux directives de l\'établissement, un nouveau mot de passe vous a été attribué de manière automatique :')

            // CORRECTION ICI : Markdown pur au lieu de <p><strong>
            ->line('**Nouveau mot de passe :** ' . $this->password)

            ->line('Vous pouvez dès à présent utiliser ce mot de passe pour vous connecter à votre espace en cliquant sur le bouton ci-dessous :')

            // CORRECTION DU BOUTON : On utilise la méthode ->action() qui génère le beau bouton bleu
            ->action("Se connecter à l'ERP", route('login'))

            // Texte en italique avec un seul astérisque *
            ->line('*Une fois connecté, nous vous recommandons de modifier ce mot de passe depuis les paramètres de votre profil.*')

            ->salutation("Cordialement,\nL'équipe **ENSAM ERP**");
    }
}
