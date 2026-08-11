<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FamiliaResource;
use App\Models\Familia;
use Illuminate\Http\JsonResponse;

class FamiliaController extends Controller
{
    public function index(): JsonResponse
    {
        $familias = Familia::withCount('retos')->orderBy('nombre')->get();

        return response()->json(FamiliaResource::collection($familias));
    }

    public function show(Familia $familia): JsonResponse
    {
        $familia->load(['retos' => function ($q) {
            $q->orderBy('nivel')->orderBy('titulo');
        }]);

        return response()->json(new FamiliaResource($familia));
    }
}
