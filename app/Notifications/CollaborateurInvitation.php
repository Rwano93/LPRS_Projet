<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DemandeEvenement;

class CollaborateurInvitation extends Notification
{
    use Queueable;

    protected $demandeEvenement;

    public function __construct(DemandeEvenement $demandeEvenement)
    {
        $this->demandeEvenement = $demandeEvenement;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $url = url('/collaborateur-demandes/' . $this->demandeEvenement->id);

        return (new MailMessage)
            ->subject('Invitation à collaborer sur un événement')
            ->line('Vous avez été invité à collaborer sur un nouvel événement.')
            ->action('Voir les détails', $url)
            ->line('Merci de votre participation!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Vous avez été invité à collaborer sur un nouvel événement.',
            'demande_evenement_id' => $this->demandeEvenement->id,
        ];
    }
}