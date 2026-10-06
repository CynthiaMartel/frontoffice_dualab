{{-- Texto plano (text/plain): sin escapar HTML, el cliente no lo interpreta. --}}
¡Hola, {!! $contacto->nombre !!}!

@switch($contacto->accion)
@case('registro')
Gracias por registrarte en DuaLab. Hemos recibido tus datos y nuestro equipo los revisará para completar el alta. Te escribiremos en los próximos días laborables.
@break
@case('demo')
Gracias por tu interés en DuaLab. Hemos recibido tu solicitud de demo y nos pondremos en contacto contigo para acordar día y hora.
@break
@default
Gracias por tu interés en DuaLab. Hemos recibido tu solicitud y te enviaremos más información muy pronto.
@endswitch

Resumen de tu solicitud
@if ($accion){!! $accion !!}
@endif
{!! $tipo !!}@if ($organizacion) · {!! $organizacion !!}@endif


Un saludo,
El equipo de DuaLab

--
Recibes este correo porque se ha enviado el formulario de contacto de DuaLab con esta dirección. Si no has sido tú, puedes ignorarlo.
