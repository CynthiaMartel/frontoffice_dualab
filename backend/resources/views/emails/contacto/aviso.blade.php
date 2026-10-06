@extends('emails.contacto.layout')

@section('contenido')
  <p style="margin:0 0 4px;font-size:12px;font-weight:bold;letter-spacing:2px;text-transform:uppercase;color:#3072AA;">Nueva solicitud</p>
  <h1 style="margin:0 0 4px;font-size:22px;color:#17283E;">{{ $accion }}</h1>
  <p style="margin:0 0 20px;color:#6B7280;">{{ $tipo }} · {{ $contacto->created_at?->timezone('Atlantic/Canary')->format('d/m/Y H:i') }}</p>

  @foreach (['Persona de contacto' => $persona, 'Datos de la solicitud' => $datos] as $titulo => $filas)
    @if (count($filas))
      <p style="margin:16px 0 8px;font-weight:bold;color:#17283E;">{{ $titulo }}</p>
      <table role="presentation" cellpadding="0" cellspacing="0" style="width:100%;font-size:14px;border-collapse:collapse;">
        @foreach ($filas as $etiqueta => $valor)
          <tr>
            <td style="padding:6px 12px 6px 0;color:#6B7280;vertical-align:top;width:40%;border-bottom:1px solid #EEF2F7;">{{ $etiqueta }}</td>
            <td style="padding:6px 0;vertical-align:top;border-bottom:1px solid #EEF2F7;white-space:pre-line;">{{ $valor }}</td>
          </tr>
        @endforeach
      </table>
    @endif
  @endforeach
@endsection

@section('pie')
  <p style="margin:0;">Aviso automático del formulario de contacto de DuaLab. Responde a este correo para contestar directamente a la persona.</p>
@endsection
