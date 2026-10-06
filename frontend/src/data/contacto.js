// Opciones de los formularios de contacto por agente (/contacto).
// Los valores deben coincidir con backend/app/Support/ContactoOpciones.php,
// que es quien valida de verdad (listas blancas).

export const PROVINCIAS = ['Las Palmas', 'Santa Cruz de Tenerife']

export const MUNICIPIOS = {
  'Las Palmas': [
    // Gran Canaria
    'Agaete', 'Agüimes', 'Artenara', 'Arucas', 'Firgas', 'Gáldar', 'Ingenio', 'La Aldea de San Nicolás',
    'Las Palmas de Gran Canaria', 'Mogán', 'Moya', 'San Bartolomé de Tirajana', 'Santa Brígida',
    'Santa Lucía de Tirajana', 'Santa María de Guía', 'Tejeda', 'Telde', 'Teror', 'Valleseco',
    'Valsequillo de Gran Canaria', 'Vega de San Mateo',
    // Lanzarote
    'Arrecife', 'Haría', 'San Bartolomé', 'Teguise', 'Tías', 'Tinajo', 'Yaiza',
    // Fuerteventura
    'Antigua', 'Betancuria', 'La Oliva', 'Pájara', 'Puerto del Rosario', 'Tuineje',
  ].sort((a, b) => a.localeCompare(b, 'es')),
  'Santa Cruz de Tenerife': [
    // Tenerife
    'Adeje', 'Arafo', 'Arico', 'Arona', 'Buenavista del Norte', 'Candelaria', 'El Rosario', 'El Sauzal',
    'El Tanque', 'Fasnia', 'Garachico', 'Granadilla de Abona', 'Guía de Isora', 'Güímar', 'Icod de los Vinos',
    'La Guancha', 'La Matanza de Acentejo', 'La Orotava', 'La Victoria de Acentejo', 'Los Realejos',
    'Los Silos', 'Puerto de la Cruz', 'San Cristóbal de La Laguna', 'San Juan de la Rambla',
    'San Miguel de Abona', 'Santa Cruz de Tenerife', 'Santa Úrsula', 'Santiago del Teide', 'Tacoronte',
    'Tegueste', 'Vilaflor de Chasna',
    // La Palma
    'Barlovento', 'Breña Alta', 'Breña Baja', 'El Paso', 'Fuencaliente de La Palma', 'Garafía',
    'Los Llanos de Aridane', 'Puntagorda', 'Puntallana', 'San Andrés y Sauces', 'Santa Cruz de La Palma',
    'Tazacorte', 'Tijarafe', 'Villa de Mazo',
    // La Gomera
    'Agulo', 'Alajeró', 'Hermigua', 'San Sebastián de La Gomera', 'Valle Gran Rey', 'Vallehermoso',
    // El Hierro
    'El Pinar de El Hierro', 'Frontera', 'Valverde',
  ].sort((a, b) => a.localeCompare(b, 'es')),
}

// Las 26 familias profesionales de FP
export const FAMILIAS_FP = [
  'Actividades Físicas y Deportivas', 'Administración y Gestión', 'Agraria', 'Artes Gráficas',
  'Artes y Artesanías', 'Comercio y Marketing', 'Edificación y Obra Civil', 'Electricidad y Electrónica',
  'Energía y Agua', 'Fabricación Mecánica', 'Hostelería y Turismo', 'Imagen Personal', 'Imagen y Sonido',
  'Industrias Alimentarias', 'Industrias Extractivas', 'Informática y Comunicaciones',
  'Instalación y Mantenimiento', 'Madera, Mueble y Corcho', 'Marítimo-Pesquera', 'Química', 'Sanidad',
  'Seguridad y Medio Ambiente', 'Servicios Socioculturales y a la Comunidad', 'Textil, Confección y Piel',
  'Transporte y Mantenimiento de Vehículos', 'Vidrio y Cerámica',
]
export const MAX_FAMILIAS_CENTRO = 4

export const SECTORES = [
  'Tecnología', 'Industria', 'Comercio', 'Hostelería y turismo', 'Sanidad', 'Educación', 'Construcción',
  'Transporte y logística', 'Agroalimentario', 'Energía', 'Servicios profesionales', 'Otro',
]

export const TAMANOS = [
  { value: 'micro',   label: 'Microempresa (1–9 personas)' },
  { value: 'pequena', label: 'Pequeña (10–49 personas)' },
  { value: 'mediana', label: 'Mediana (50–249 personas)' },
  { value: 'grande',  label: 'Grande (250 o más)' },
]

export const COLABORA = [
  { value: 'si',        label: 'Sí' },
  { value: 'no',        label: 'No' },
  { value: 'valorando', label: 'Lo estamos valorando' },
]

export const CURSOS = [
  { value: '1', label: '1.º curso' },
  { value: '2', label: '2.º curso' },
]

export const TIPOS_ENTIDAD = [
  { value: 'consejeria',   label: 'Consejería / Gobierno autonómico' },
  { value: 'cabildo',      label: 'Cabildo insular' },
  { value: 'ayuntamiento', label: 'Ayuntamiento' },
  { value: 'empleo',       label: 'Servicio público de empleo' },
  { value: 'camara',       label: 'Cámara de comercio' },
  { value: 'asociacion',   label: 'Asociación o fundación' },
  { value: 'otro',         label: 'Otro' },
]

export const AMBITOS = [
  { value: 'local',      label: 'Local' },
  { value: 'insular',    label: 'Insular' },
  { value: 'autonomico', label: 'Autonómico' },
  { value: 'estatal',    label: 'Estatal' },
]

export const INTERESES = {
  empresa: [
    { value: 'plantear_retos',      label: 'Plantear retos o proyectos' },
    { value: 'talento_practicas',   label: 'Acceder a talento en prácticas' },
    { value: 'colaborar_centros',   label: 'Colaborar con centros educativos' },
    { value: 'casos_exito',         label: 'Conocer casos de éxito' },
    { value: 'info_funcionamiento', label: 'Recibir información sobre el funcionamiento' },
    { value: 'otro',                label: 'Otro (especifica)' },
  ],
  alumno: [
    { value: 'practicas',    label: 'Encontrar prácticas en empresas' },
    { value: 'retos',        label: 'Participar en retos' },
    { value: 'competencias', label: 'Desarrollar mis competencias' },
    { value: 'casos_exito',  label: 'Conocer casos de éxito' },
    { value: 'noticias',     label: 'Recibir noticias y oportunidades' },
    { value: 'otro',         label: 'Otra opción (especifica)' },
  ],
  administracion: [
    { value: 'gestionar_programas', label: 'Implantar y gestionar programas de FP Dual' },
    { value: 'conectar_agentes',    label: 'Conectar centros educativos y empresas' },
    { value: 'monitorizar_impacto', label: 'Monitorizar el impacto y resultados' },
    { value: 'informes',            label: 'Acceder a informes y datos para la toma de decisiones' },
    { value: 'casos_exito',         label: 'Conocer casos de éxito' },
    { value: 'otro',                label: 'Otra opción (especifica)' },
  ],
}
