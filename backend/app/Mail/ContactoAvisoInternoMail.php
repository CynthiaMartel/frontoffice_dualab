<?php

namespace App\Mail;

use App\Models\Contacto;
use App\Support\ContactoResumen;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/** Aviso al equipo de DuaLab con todos los datos de una nueva solicitud. */
class ContactoAvisoInternoMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public int $tries = 3;

    public array $backoff = [60, 300];

    public function __construct(public Contacto $contacto) {}

    public function envelope(): Envelope
    {
        $accion = ContactoResumen::ACCIONES[$this->contacto->accion] ?? 'Solicitud de contacto';
        $tipo = ContactoResumen::TIPOS[$this->contacto->tipo] ?? $this->contacto->tipo;
        $org = ContactoResumen::organizacion($this->contacto);

        return new Envelope(
            subject: "{$accion} · {$tipo}".($org ? " · {$org}" : ''),
            // "Responder" contesta directamente a quien envió el formulario
            replyTo: [new Address($this->contacto->email, trim($this->contacto->nombre.' '.$this->contacto->apellidos))],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contacto.aviso',
            text: 'emails.contacto.aviso-texto',
            with: [
                'tipo' => ContactoResumen::TIPOS[$this->contacto->tipo] ?? $this->contacto->tipo,
                'accion' => ContactoResumen::ACCIONES[$this->contacto->accion] ?? 'Formulario simple',
                'persona' => ContactoResumen::persona($this->contacto),
                'datos' => ContactoResumen::datos($this->contacto),
            ],
        );
    }
}
