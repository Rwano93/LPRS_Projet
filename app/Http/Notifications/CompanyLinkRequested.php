<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Entreprise;

class CompanyLinkRequested extends Notification
{
    use Queueable;

    protected $requestingUser;
    protected $entreprise;

    public function __construct(User $requestingUser, Entreprise $entreprise)
    {
        $this->requestingUser = $requestingUser;
        $this->entreprise = $entreprise;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle demande de rattachement à une entreprise')
            ->line($this->requestingUser->name . ' souhaite se rattacher à ' . $this->entreprise->nom)
            ->action('Voir la demande', route('entreprises.show', $this->entreprise))
            ->line('Merci de vérifier cette demande.');
    }

    public function toArray($notifiable)
    {
        return [
            'requesting_user_id' => $this->requestingUser->id,
            'entreprise_id' => $this->entreprise->id,
            'type' => 'company_link_request',
        ];
    }
}

