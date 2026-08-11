<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRetoRequest;
use App\Http\Resources\RetoResource;
use App\Models\Reto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RetoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Reto::with('familia')->orderBy('created_at', 'desc');

        if ($request->filled('familia_id')) {
            $query->where('familia_id', $request->familia_id);
        }
        if ($request->filled('nivel')) {
            $query->where('nivel', $request->nivel);
        }
        if ($request->filled('search')) {
            $query->where('titulo', 'like', '%'.$request->search.'%');
        }

        return response()->json(RetoResource::collection($query->paginate(12)));
    }

    public function show(Reto $reto): JsonResponse
    {
        $reto->load(['familia', 'objetivos', 'recursos']);

        return response()->json(new RetoResource($reto));
    }

    public function store(StoreRetoRequest $request): JsonResponse
    {
        $reto = Reto::create($request->validated());

        if ($request->has('objetivos')) {
            foreach ($request->objetivos as $i => $texto) {
                $reto->objetivos()->create(['descripcion' => $texto, 'orden' => $i + 1]);
            }
        }

        if ($request->has('recursos')) {
            foreach ($request->recursos as $recurso) {
                $reto->recursos()->create(['nombre' => $recurso]);
            }
        }

        return response()->json(new RetoResource($reto->load(['familia', 'objetivos', 'recursos'])), 201);
    }

    public function update(StoreRetoRequest $request, Reto $reto): JsonResponse
    {
        $reto->update($request->validated());

        return response()->json(new RetoResource($reto->load(['familia', 'objetivos', 'recursos'])));
    }

    public function destroy(Reto $reto): JsonResponse
    {
        $reto->delete();

        return response()->json(null, 204);
    }
}
