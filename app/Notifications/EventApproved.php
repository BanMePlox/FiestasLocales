<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventApproved extends Notification
{
    use Queueable;

    public function __construct(public readonly Event $event) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Tu evento \"{$this->event->name}\" ya está publicado")
            ->greeting("¡Hola, {$notifiable->name}!")
            ->line("Buenas noticias: hemos revisado tu propuesta y ya está publicada en FiestasLocales.")
            ->line("**{$this->event->name}**")
            ->line("{$this->event->venue} · {$this->event->municipality->name}")
            ->line($this->event->starts_at->translatedFormat('j \d\e F \d\e Y') . ' a las ' . $this->event->starts_at->format('H:i'))
            ->action('Ver el evento', route('events.show', $this->event))
            ->line('Gracias por contribuir a hacer crecer la comunidad.')
            ->salutation('El equipo de FiestasLocales');
    }
}
