@extends('emails.contacto.layout')

{{-- Solo se repiten datos no libres (nombre, tipo, organización): nunca el mensaje
     del formulario, para no reenviar texto arbitrario desde el dominio. --}}
@section('contenido')
  <h1 style="margin:0 0 16px;font-size:22px;color:#17283E;">¡Hola, {{ $contacto->nombre }}!</h1>

  @switch($contacto->accion)
    @case('registro')
      <p style="margin:0 0 12px;">Gracias por registrarte en DuaLab. Hemos recibido tus datos y nuestro equipo los revisará para completar el alta. Te escribiremos en los próximos días laborables.</p>
      @break
    @case('demo')
      <p style="margin:0 0 12px;">Gracias por tu interés en DuaLab. Hemos recibido tu solicitud de demo y nos pondremos en contacto contigo para acordar día y hora.</p>
      @break
    @default
      <p style="margin:0 0 12px;">Gracias por tu interés en DuaLab. Hemos recibido tu solicitud y te enviaremos más información muy pronto.</p>
  @endswitch

  <table role="presentation" cellpadding="0" cellspacing="0" style="width:100%;margin:20px 0;background:#F6FAFC;border-radius:12px;">
    <tr><td style="padding:16px 20px;font-size:14px;">
      <p style="margin:0 0 6px;font-weight:bold;color:#17283E;">Resumen de tu solicitud</p>
      @if ($accion)<p style="margin:0;">{{ $accion }}</p>@endif
      <p style="margin:0;">{{ $tipo }}@if ($organizacion) · {{ $organizacion }}@endif</p>
    </td></tr>
  </table>

  <p style="margin:0 0 4px;">Un saludo,</p>
  <p style="margin:0;font-weight:bold;color:#17283E;">El equipo de DuaLab</p>
@endsection

@section('pie')
  <p style="margin:0;">Recibes este correo porque se ha enviado el formulario de contacto de DuaLab con esta dirección. Si no has sido tú, puedes ignorarlo.</p>
@endsection
