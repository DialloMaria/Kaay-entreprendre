<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class InscriptionEvenement extends Notification
{
    protected $event;
    protected $domaine;

    /**
     * Crée une nouvelle instance de notification.
     */
    public function __construct($event, $domaine)
    {
        $this->event = $event;
        $this->domaine = $domaine;
    }

    /**
     * Détermine les canaux de notification que le notifiable doit recevoir.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Envoie une notification par e-mail.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Inscription à un événement dans le domaine: ' . $this->domaine->titre)
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Vous vous êtes inscrit avec succès à l\'événement: ' . $this->event->titre)
            ->line('Description: ' . $this->event->description)
            ->line($this->event->online ? 'Cet événement se déroulera en ligne.' : 'Lieu: ' . $this->event->lieu)
            ->line('Domaine: ' . $this->domaine->nom)
            ->line('Merci de votre inscription et à bientôt !');
    }

    /**
     * Enregistre les détails de la notification dans la base de données.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'event_title' => $this->event->titre,
            'event_description' => $this->event->description,
            'event_location' => $this->event->online ? 'En ligne' : $this->event->lieu,
            'domaine_title' => $this->domaine->titre,
        ];
    }
}
