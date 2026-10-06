<?php

namespace App\Support;

/**
 * Valores permitidos (listas blancas) de los formularios de contacto por agente.
 * Deben coincidir con frontend/src/data/contacto.js.
 */
final class ContactoOpciones
{
    public const TIPOS = ['centro', 'empresa', 'alumno', 'administracion'];

    /** Formularios por agente desactivados de momento (frontend: contactoConfig.js `bloqueado`). */
    public const TIPOS_BLOQUEADOS = ['alumno'];

    public const ACCIONES = ['registro', 'info', 'demo'];

    public const PROVINCIAS = ['Las Palmas', 'Santa Cruz de Tenerife'];

    public const FAMILIAS = [
        'Actividades Físicas y Deportivas', 'Administración y Gestión', 'Agraria', 'Artes Gráficas',
        'Artes y Artesanías', 'Comercio y Marketing', 'Edificación y Obra Civil', 'Electricidad y Electrónica',
        'Energía y Agua', 'Fabricación Mecánica', 'Hostelería y Turismo', 'Imagen Personal', 'Imagen y Sonido',
        'Industrias Alimentarias', 'Industrias Extractivas', 'Informática y Comunicaciones',
        'Instalación y Mantenimiento', 'Madera, Mueble y Corcho', 'Marítimo-Pesquera', 'Química', 'Sanidad',
        'Seguridad y Medio Ambiente', 'Servicios Socioculturales y a la Comunidad', 'Textil, Confección y Piel',
        'Transporte y Mantenimiento de Vehículos', 'Vidrio y Cerámica',
    ];

    public const SECTORES = [
        'Tecnología', 'Industria', 'Comercio', 'Hostelería y turismo', 'Sanidad', 'Educación', 'Construcción',
        'Transporte y logística', 'Agroalimentario', 'Energía', 'Servicios profesionales', 'Otro',
    ];

    public const TAMANOS = ['micro', 'pequena', 'mediana', 'grande'];

    public const COLABORA = ['si', 'no', 'valorando'];

    public const CURSOS = ['1', '2'];

    public const TIPOS_ENTIDAD = [
        'consejeria', 'cabildo', 'ayuntamiento', 'empleo', 'camara', 'asociacion', 'otro',
    ];

    public const AMBITOS = ['local', 'insular', 'autonomico', 'estatal'];

    public const INTERESES = [
        'empresa' => ['plantear_retos', 'talento_practicas', 'colaborar_centros', 'casos_exito', 'info_funcionamiento', 'otro'],
        'alumno' => ['practicas', 'retos', 'competencias', 'casos_exito', 'noticias', 'otro'],
        'administracion' => ['gestionar_programas', 'conectar_agentes', 'monitorizar_impacto', 'informes', 'casos_exito', 'otro'],
    ];
}
