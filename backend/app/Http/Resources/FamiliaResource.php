<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamiliaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'nombre'      => $this->nombre,
            'slug'        => $this->slug,
            'descripcion' => $this->descripcion,
            'icono'       => $this->icono,
            'color_hex'   => $this->color_hex,
            'retos_count' => $this->whenCounted('retos'),
            'retos'       => RetoResource::collection($this->whenLoaded('retos')),
        ];
    }
}
