<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Domaine;

class InscriptionEvenement extends Notification
{
    use Queueable;

    protected $event;
    protected $domaine;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($event, $domaine)
    {
        $this->event = $event;
        $this->domaine = $domaine;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
{
    $mailMessage = (new MailMessage)
                    ->subject('Inscription à un événement dans le domaine: ' . $this->domaine->titre)
                    ->greeting('Bonjour ' . $notifiable->name)
                    ->line('Vous vous êtes inscrit avec succès à l\'événement: ' . $this->event->titre)
                    ->line('Description: ' . $this->event->description);

    // Si l'événement est en ligne, ajouter une ligne spécifique
    if ($this->event->online) {
        $mailMessage->line('Cet événement se déroulera en ligne.');
    } else {
        $mailMessage->line('Lieu: ' . $this->event->lieu);
    }

    $mailMessage->line('Domaine: ' . $this->domaine->nom)
                ->line('Merci de votre inscription et à bientôt !');

    return $mailMessage;
}

}
