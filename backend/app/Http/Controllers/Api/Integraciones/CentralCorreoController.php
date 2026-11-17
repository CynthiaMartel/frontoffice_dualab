<?php

namespace App\Http\Controllers\Api\Integraciones;

use App\Http\Controllers\Api\Integraciones\Concerns\RegistraActividadCentral;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ListarCorreosRequest;
use App\Http\Requests\Admin\UpdateCorreoRequest;
use App\Http\Requests\Integraciones\EnviarCorreoCentralRequest;
use App\Http\Resources\Admin\CorreoResource;
use App\Models\CorreoAdjunto;
use App\Models\CorreoEnvio;
use App\Models\CorreoMensaje;
use App\Services\BandejaCorreoService;
use App\Services\CorreoEnvioService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Correo de info@ para DuaLab Central («Primer contacto»), por la API firmada (VerificarFirmaCentral).
 * Misma lógica que el Correo de Gestión web: la copia local la llena `correo:sincronizar` y los envíos
 * salen por la cola con el SMTP de info@. Central solo es la pantalla.
 */
class CentralCorreoController extends Controller
{
    use RegistraActividadCentral;

    private const ESTADOS = ['nuevo' => 'no leído', 'leido' => 'leído', 'archivado' => 'archivado'];

    public function __construct(private BandejaCorreoService $bandeja, private CorreoEnvioService $envios) {}

    public function index(ListarCorreosRequest $request): AnonymousResourceCollection
    {
        $f = $request->validated();
        $pagina = $this->bandeja->listar($f, min((int) ($f['per_page'] ?? 25), 100));

        return CorreoResource::collection($pagina)->additional([
            'resumen'    => $this->bandeja->resumen($f['buzon'] ?? 'info'),
            'salida'     => $this->bandeja->salida($f['buzon'] ?? 'info'),
            'remitentes' => $this->bandeja->remitentesConocidos($pagina->getCollection()),
        ]);
    }

    /** Abrir un correo lo marca como leído (solo en la copia local, como en Gestión web). */
    public function show(CorreoMensaje $correo): CorreoResource
    {
        $this->bandeja->marcarLeido($correo);

        return new CorreoResource($correo->load('adjuntos'));
    }

    public function update(UpdateCorreoRequest $request, CorreoMensaje $correo): CorreoResource
    {
        $this->bandeja->cambiarEstado($correo, $request->validated('estado'));
        $this->registrarCentral($request, 'correo', 'estado', "marcó el correo #{$correo->id} como ".self::ESTADOS[$correo->estado], 'correo', $correo->id);

        return new CorreoResource($correo->load('adjuntos'));
    }

    public function adjunto(CorreoMensaje $correo, CorreoAdjunto $adjunto): StreamedResponse
    {
        return $this->bandeja->descargar($adjunto);
    }

    /** Lo deja en la bandeja de salida; sale por la cola (202: aún no se ha enviado). */
    public function enviar(EnviarCorreoCentralRequest $request): JsonResponse
    {
        $envio = $this->envios->crear(null, $request->validated(), $request->file('adjuntos', []));
        $this->registrarCentral($request, 'correo', $envio->tipo, "envió un correo (envío #{$envio->id})", 'correo_envio', $envio->id);

        return response()->json(['id' => $envio->id, 'estado' => $envio->estado], 202);
    }

    public function reintentar(Request $request, CorreoEnvio $envio): JsonResponse
    {
        $this->envios->reintentar($envio);
        $this->registrarCentral($request, 'correo', 'reintentar', "reintentó el envío #{$envio->id}", 'correo_envio', $envio->id);

        return response()->json(['id' => $envio->id, 'estado' => $envio->estado], 202);
    }

    public function descartar(Request $request, CorreoEnvio $envio): JsonResponse
    {
        $this->envios->descartar($envio);
        $this->registrarCentral($request, 'correo', 'descartar', "descartó el envío fallido #{$envio->id}", 'correo_envio', $envio->id);

        return response()->json(null, 204);
    }
}
