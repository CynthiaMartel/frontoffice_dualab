<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    public const ESTADOS = ['nuevo', 'leido', 'archivado'];

    // `estado` y `leido_en` solo los cambia el panel (forceFill en ContactoAdminService).
    protected $fillable = ['nombre', 'apellidos', 'email', 'tipo', 'accion', 'telefono', 'cargo', 'datos', 'pagina_origen'];

    protected function casts(): array
    {
        return [
            'datos'    => 'array',
            'leido_en' => 'datetime',
        ];
    }

    /** Correos enviados desde el panel en respuesta a este formulario */
    public function respuestas()
    {
        return $this->hasMany(CorreoEnvio::class)->latest();
    }
}
