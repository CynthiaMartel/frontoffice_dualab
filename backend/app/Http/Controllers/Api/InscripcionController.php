<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InscripcionResource;
use App\Models\Reto;
use App\Models\Inscripcion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $inscripciones = $request->user()
            ->inscripciones()
            ->with('reto.familia')
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();

        return response()->json(InscripcionResource::collection($inscripciones));
    }

    public function store(Request $request, Reto $reto): JsonResponse
    {
        $user = $request->user();

        if ($user->inscripciones()->where('reto_id', $reto->id)->exists()) {
            return response()->json(['message' => 'Ya estás inscrito en este reto.'], 409);
        }

        $inscripcion = $user->inscripciones()->create([
            'reto_id' => $reto->id,
            'estado'  => 'en_progreso',
        ]);

        return response()->json(new InscripcionResource($inscripcion->load('reto.familia')), 201);
    }

    public function destroy(Request $request, Inscripcion $inscripcion): JsonResponse
    {
        $this->authorize('delete', $inscripcion);

        $inscripcion->delete();

        return response()->json(null, 204);
    }
}
