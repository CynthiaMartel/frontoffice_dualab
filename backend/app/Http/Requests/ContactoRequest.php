<?php

namespace App\Http\Requests;

use App\Support\ContactoOpciones as Op;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Dos formatos:
 * - Formulario simple de la home (sin `accion`): nombre, email, tipo, teléfono.
 * - Formularios por agente de /contacto (con `accion`): persona de contacto
 *   completa + campos propios del tipo, que acaban en `datos` (ver datosEspecificos()).
 */
class ContactoRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'nombre'   => ['required', 'string', 'max:120'],
            'email'    => ['required', 'email', 'max:255'],
            'tipo'     => ['required', Rule::in($this->filled('accion')
                ? array_diff(Op::TIPOS, Op::TIPOS_BLOQUEADOS)
                : ['empresa', 'centro', 'alumno'])],
            'telefono' => ['nullable', 'string', 'max:20'],
        ];

        if (! $this->filled('accion')) {
            return $rules;
        }

        // array_merge (no +): `telefono` pasa de opcional a obligatorio.
        $rules = array_merge($rules, [
            'accion'    => ['required', Rule::in(Op::ACCIONES)],
            'apellidos' => ['required', 'string', 'max:120'],
            'telefono'  => ['required', 'string', 'max:20'],
        ]);

        return $rules + match ($this->input('tipo')) {
            'centro' => [
                'cargo'                => ['required', 'string', 'max:120'],
                'centro_nombre'        => ['required', 'string', 'max:160'],
                'direccion'            => ['required', 'string', 'max:200'],
                'municipio'            => ['required', 'string', 'max:120'],
                'provincia'            => ['required', Rule::in(Op::PROVINCIAS)],
                'familias'             => ['required', 'array', 'min:1', 'max:4'],
                'familias.*'           => ['distinct', Rule::in(Op::FAMILIAS)],
            ],
            'empresa' => [
                'cargo'                => ['required', 'string', 'max:120'],
                'empresa_nombre'       => ['required', 'string', 'max:160'],
                'cif'                  => ['required', 'string', 'max:15'],
                'sector'               => ['required', Rule::in(Op::SECTORES)],
                'provincia'            => ['required', Rule::in(Op::PROVINCIAS)],
                'municipio'            => ['required', 'string', 'max:120'],
                'direccion'            => ['required', 'string', 'max:200'],
                'tamano'               => ['required', Rule::in(Op::TAMANOS)],
                'colabora'             => ['required', Rule::in(Op::COLABORA)],
                'intereses'            => ['nullable', 'array'],
                'intereses.*'          => ['distinct', Rule::in(Op::INTERESES['empresa'])],
                'mensaje'              => ['nullable', 'string', 'max:2000'],
            ],
            'alumno' => [
                'fecha_nacimiento'     => ['required', 'date', 'before:today'],
                'centro_educativo'     => ['required', 'string', 'max:160'],
                'ciclo'                => ['required', 'string', 'max:160'],
                'curso'                => ['required', Rule::in(Op::CURSOS)],
                'familia'              => ['required', Rule::in(Op::FAMILIAS)],
                'intereses'            => ['nullable', 'array'],
                'intereses.*'          => ['distinct', Rule::in(Op::INTERESES['alumno'])],
                'mensaje'              => ['nullable', 'string', 'max:2000'],
            ],
            'administracion' => [
                'cargo'                => ['required', 'string', 'max:120'],
                'entidad_nombre'       => ['required', 'string', 'max:160'],
                'cif'                  => ['required', 'string', 'max:15'],
                'tipo_entidad'         => ['required', Rule::in(Op::TIPOS_ENTIDAD)],
                'ambito'               => ['required', Rule::in(Op::AMBITOS)],
                'direccion'            => ['required', 'string', 'max:200'],
                'municipio'            => ['required', 'string', 'max:120'],
                'provincia'            => ['required', Rule::in(Op::PROVINCIAS)],
                'intereses'            => ['nullable', 'array'],
                'intereses.*'          => ['distinct', Rule::in(Op::INTERESES['administracion'])],
                'mensaje'              => ['nullable', 'string', 'max:2000'],
            ],
            default => [],
        };
    }

    /** Mensajes en español (el proyecto no tiene traducciones de validación). */
    public function messages(): array
    {
        return [
            'required'        => 'Este campo es obligatorio.',
            'string'          => 'Este campo no es válido.',
            'email'           => 'Introduce un email válido.',
            'max'             => 'Es demasiado largo (máximo :max caracteres).',
            'in'              => 'Selecciona una opción válida.',
            'array'           => 'Selecciona una opción válida.',
            'date'            => 'Introduce una fecha válida.',
            'before'          => 'La fecha debe ser anterior a hoy.',
            'distinct'        => 'Hay una opción repetida.',
            'familias.min'    => 'Selecciona al menos una familia profesional.',
            'familias.max'    => 'Puedes seleccionar como máximo :max familias.',
            'tipo.in'         => 'Este tipo de solicitud no está disponible.',
        ];
    }

    /** Campos comunes que van a columnas propias de `contactos`. */
    public function datosComunes(): array
    {
        return collect($this->validated())
            ->only(['nombre', 'apellidos', 'email', 'tipo', 'accion', 'telefono', 'cargo'])
            ->all();
    }

    /** Campos propios del agente (ya validados por lista blanca) para la columna JSON `datos`. */
    public function datosEspecificos(): ?array
    {
        $especificos = collect($this->validated())
            ->except(['nombre', 'apellidos', 'email', 'tipo', 'accion', 'telefono', 'cargo'])
            ->all();

        return $especificos ?: null;
    }
}
