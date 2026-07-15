<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NouvelleTacheNotification extends Notification
{
    use Queueable;

    public $tache;

    public function __construct($tache)
    {
        $this->tache = $tache;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle tâche assignée')
            ->greeting('Bonjour '.$notifiable->name_users.',')
            ->line('Une nouvelle tâche vous a été assignée.')
            ->line('Titre : '.$this->tache->titre)
            ->line('Priorité : '.$this->tache->priorite)
            ->line('Date limite : '.$this->tache->date_limite)
            ->action('Voir mes tâches', url('/taches'))
            ->line('Merci.');
    }
}