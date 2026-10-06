<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactoRequest;
use App\Services\ContactoService;
use Illuminate\Http\JsonResponse;

class ContactoController extends Controller
{
    private const MENSAJE_OK = 'Solicitud recibida. Nos pondremos en contacto pronto.';

    public function store(ContactoRequest $request, ContactoService $contactos): JsonResponse
    {
        // Honeypot: campo oculto que solo rellenan los bots. Se responde igual
        // que a un envío válido para no darles pistas, pero no se guarda nada.
        if ($request->filled('website')) {
            return response()->json(['message' => self::MENSAJE_OK], 201);
        }

        $contactos->registrar($request->datosComunes(), $request->datosEspecificos());

        return response()->json(['message' => self::MENSAJE_OK], 201);
    }
}
