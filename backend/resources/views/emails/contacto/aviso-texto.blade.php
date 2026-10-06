{{-- Texto plano (text/plain): sin escapar HTML, el cliente no lo interpreta. --}}
NUEVA SOLICITUD — {!! $accion !!}
{!! $tipo !!} · {!! $contacto->created_at?->timezone('Atlantic/Canary')->format('d/m/Y H:i') !!}

PERSONA DE CONTACTO
@foreach ($persona as $etiqueta => $valor)
{!! $etiqueta !!}: {!! $valor !!}
@endforeach

@if (count($datos))
DATOS DE LA SOLICITUD
@foreach ($datos as $etiqueta => $valor)
{!! $etiqueta !!}: {!! $valor !!}
@endforeach
@endif

--
Aviso automático del formulario de contacto de DuaLab. Responde a este correo para contestar directamente a la persona.
