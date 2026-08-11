<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RetoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'familia_id'  => $this->familia_id,
            'titulo'      => $this->titulo,
            'descripcion' => $this->descripcion,
            'nivel'       => $this->nivel,
            'duracion'    => $this->duracion,
            'created_at'  => $this->created_at,
            'familia'     => new FamiliaResource($this->whenLoaded('familia')),
            'objetivos'   => ObjetivoResource::collection($this->whenLoaded('objetivos')),
            'recursos'    => RecursoResource::collection($this->whenLoaded('recursos')),
        ];
    }
}
