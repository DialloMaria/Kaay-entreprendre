<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DomaineInscription extends Notification
{
    use Queueable;

    public $domaine;

    public function __construct($domaine)
    {
        $this->domaine = $domaine;
    }

    public function via($notifiable)
    {
        // Méthodes de notification (par exemple: mail, database)
        return ['mail','database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Inscription à un domaine réussie')
                    ->greeting('Bonjour, ' . $notifiable->nom)
                    ->line('Vous vous êtes inscrit avec succès au domaine : ' . $this->domaine->nom)
                    ->action('Voir le domaine', url('/api/domaines/' . $this->domaine->id))
                    ->line('Merci d\'utiliser notre application!');
    }

    // Optionnel : Si tu veux stocker la notification dans la base de données
    public function toArray($notifiable)
    {
        return [
            'domaine_id' => $this->domaine->id,
            'domaine_nom' => $this->domaine->nom,
        ];
    }
}
