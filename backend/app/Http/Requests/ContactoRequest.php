<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombre'   => 'required|string|max:120',
            'email'    => 'required|email',
            'tipo'     => 'required|in:empresa,centro,alumno',
            'telefono' => 'nullable|string|max:20',
        ];
    }
}
