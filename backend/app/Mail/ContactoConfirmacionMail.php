<?php

namespace App\Mail;

use App\Models\Contacto;
use App\Support\ContactoResumen;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/** Confirmación a la persona que ha enviado el formulario de contacto. */
class ContactoConfirmacionMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public int $tries = 3;

    public array $backoff = [60, 300];

    public function __construct(public Contacto $contacto) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Hemos recibido tu solicitud · DuaLab');
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contacto.confirmacion',
            text: 'emails.contacto.confirmacion-texto',
            with: [
                'organizacion' => ContactoResumen::organizacion($this->contacto),
                'tipo' => ContactoResumen::TIPOS[$this->contacto->tipo] ?? $this->contacto->tipo,
                'accion' => ContactoResumen::ACCIONES[$this->contacto->accion] ?? null,
            ],
        );
    }
}
