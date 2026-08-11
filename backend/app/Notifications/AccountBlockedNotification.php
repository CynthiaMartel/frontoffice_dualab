<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountBlockedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Tu cuenta ha sido bloqueada')
            ->line('Hemos bloqueado tu cuenta tras detectar varios intentos de inicio de sesión fallidos.')
            ->line('Si no has sido tú, te recomendamos revisar la seguridad de tu correo electrónico.')
            ->line('Contacta con soporte para desbloquear tu cuenta.');
    }
}
