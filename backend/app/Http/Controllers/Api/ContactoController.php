<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactoRequest;
use App\Models\Contacto;
use Illuminate\Http\JsonResponse;

class ContactoController extends Controller
{
    public function store(ContactoRequest $request): JsonResponse
    {
        Contacto::create($request->validated());

        return response()->json(['message' => 'Solicitud recibida. Nos pondremos en contacto pronto.'], 201);
    }
}
