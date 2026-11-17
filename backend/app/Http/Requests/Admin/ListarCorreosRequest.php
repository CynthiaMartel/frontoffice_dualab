<?php

namespace App\Http\Requests\Admin;

use App\Models\CorreoMensaje;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListarCorreosRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'buzon'    => ['nullable', Rule::in(array_keys(config('correo.buzones')))],
            'carpeta'  => ['nullable', Rule::in(['recibidos', 'enviados'])],
            'estado'   => ['nullable', Rule::in(CorreoMensaje::ESTADOS)],
            'buscar'   => ['nullable', 'string', 'max:100'],
            'adjuntos' => ['nullable', 'boolean'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }
}
