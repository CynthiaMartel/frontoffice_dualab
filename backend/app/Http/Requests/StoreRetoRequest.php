<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRetoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'familia_id'  => 'required|exists:familias,id',
            'titulo'      => 'required|string|max:200',
            'descripcion' => 'required|string',
            'nivel'       => 'required|in:basico,intermedio,avanzado',
            'duracion'    => 'nullable|string|max:50',
            'objetivos'   => 'nullable|array',
            'objetivos.*' => 'string|max:255',
            'recursos'    => 'nullable|array',
            'recursos.*'  => 'string|max:100',
        ];
    }
}
