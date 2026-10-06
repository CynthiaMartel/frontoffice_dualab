<?php

namespace App\Support;

use App\Models\Contacto;

/**
 * Convierte una solicitud de contacto en filas legibles (etiqueta => valor)
 * para los correos. Los valores de lista blanca se traducen a su texto.
 */
final class ContactoResumen
{
    public const TIPOS = [
        'centro' => 'Centro educativo',
        'empresa' => 'Empresa',
        'alumno' => 'Alumno/a',
        'administracion' => 'Entidad / Administración',
    ];

    public const ACCIONES = [
        'registro' => 'Registro',
        'info' => 'Solicitud de más información',
        'demo' => 'Solicitud de demo',
    ];

    private const CAMPOS = [
        'centro_nombre' => 'Centro', 'empresa_nombre' => 'Empresa', 'entidad_nombre' => 'Entidad / organismo',
        'cif' => 'CIF', 'sector' => 'Sector', 'tamano' => 'Tamaño', 'colabora' => '¿Colabora con centros?',
        'tipo_entidad' => 'Tipo de entidad', 'ambito' => 'Ámbito territorial',
        'direccion' => 'Dirección', 'municipio' => 'Municipio', 'provincia' => 'Provincia',
        'familias' => 'Familias profesionales', 'familia' => 'Familia profesional',
        'fecha_nacimiento' => 'Fecha de nacimiento', 'centro_educativo' => 'Centro educativo',
        'ciclo' => 'Ciclo formativo', 'curso' => 'Curso', 'intereses' => 'Intereses', 'mensaje' => 'Mensaje',
    ];

    private const VALORES = [
        'tamano' => ['micro' => 'Microempresa (1–9)', 'pequena' => 'Pequeña (10–49)', 'mediana' => 'Mediana (50–249)', 'grande' => 'Grande (250 o más)'],
        'colabora' => ['si' => 'Sí', 'no' => 'No', 'valorando' => 'Lo están valorando'],
        'tipo_entidad' => [
            'consejeria' => 'Consejería / Gobierno autonómico', 'cabildo' => 'Cabildo insular', 'ayuntamiento' => 'Ayuntamiento',
            'empleo' => 'Servicio público de empleo', 'camara' => 'Cámara de comercio', 'asociacion' => 'Asociación o fundación', 'otro' => 'Otro',
        ],
        'ambito' => ['local' => 'Local', 'insular' => 'Insular', 'autonomico' => 'Autonómico', 'estatal' => 'Estatal'],
        'curso' => ['1' => '1.º curso', '2' => '2.º curso'],
        'intereses' => [
            'plantear_retos' => 'Plantear retos o proyectos', 'talento_practicas' => 'Acceder a talento en prácticas',
            'colaborar_centros' => 'Colaborar con centros educativos', 'casos_exito' => 'Conocer casos de éxito',
            'info_funcionamiento' => 'Recibir información sobre el funcionamiento', 'practicas' => 'Encontrar prácticas en empresas',
            'retos' => 'Participar en retos', 'competencias' => 'Desarrollar competencias', 'noticias' => 'Recibir noticias y oportunidades',
            'gestionar_programas' => 'Implantar y gestionar programas de FP Dual', 'conectar_agentes' => 'Conectar centros educativos y empresas',
            'monitorizar_impacto' => 'Monitorizar el impacto y resultados', 'informes' => 'Acceder a informes y datos', 'otro' => 'Otro',
        ],
    ];

    /** Nombre de la organización (centro, empresa o entidad), si lo hay. */
    public static function organizacion(Contacto $c): ?string
    {
        $d = $c->datos ?? [];

        return $d['centro_nombre'] ?? $d['empresa_nombre'] ?? $d['entidad_nombre'] ?? null;
    }

    /** @return array<string, string> Datos de la persona de contacto. */
    public static function persona(Contacto $c): array
    {
        return array_filter([
            'Nombre' => trim($c->nombre.' '.$c->apellidos),
            'Cargo' => $c->cargo,
            'Email' => $c->email,
            'Teléfono' => $c->telefono,
        ]);
    }

    /** @return array<string, string> Datos propios del agente, con etiquetas legibles. */
    public static function datos(Contacto $c): array
    {
        $filas = [];
        foreach (self::CAMPOS as $clave => $etiqueta) {
            $valor = $c->datos[$clave] ?? null;
            if ($valor === null || $valor === '' || $valor === []) {
                continue;
            }
            $filas[$etiqueta] = is_array($valor)
                ? implode(', ', array_map(fn ($v) => self::texto($clave, $v), $valor))
                : self::texto($clave, $valor);
        }

        return $filas;
    }

    private static function texto(string $clave, string $valor): string
    {
        return self::VALORES[$clave][$valor] ?? $valor;
    }
}
