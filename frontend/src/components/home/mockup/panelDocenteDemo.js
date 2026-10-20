// Datos ficticios para la maqueta del panel de inicio (/panel-docente de la
// herramienta DuaLab) que se muestra en "Toda la gestión en un mismo lugar".
// Copia de la captura del panel de octubre de 2026. Solo ilustrativos: no salen de la API.

export const usuario = { nombre: 'DuaLab', rol: 'Administrador · DuaLab' }

// Trazos SVG (viewBox 24×24, stroke) — mismos que config/navegacion.js de la herramienta
export const ICONOS = {
  inicio:       'M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z',
  capas:        'M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5',
  portapapeles: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M10 3h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V4a1 1 0 011-1zM9 12l2 2 4-4',
  grafica:      'M3 3v18h18M7 15l4-6 4 4 5-8',
  alumnado:     'M22 10L12 5 2 10l10 5 10-5zM6 12v5c3 2 9 2 12 0v-5',
  empresa:      'M3 21h18M5 21V7l7-4 7 4v14M9 9h1M14 9h1M9 13h1M14 13h1M9 17h1M14 17h1',
  calendario:   'M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2zM16 2v4M8 2v4M3 10h18',
  campana:      'M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0',
  recursos:     'M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2zM22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z',
  usuarios:     'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75',
  masCirculo:   'M22 12a10 10 0 11-20 0 10 10 0 0120 0zM12 8v8M8 12h8',
  libro:        'M4 19.5A2.5 2.5 0 016.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 014 22v-15A2.5 2.5 0 016.5 2zM9 7h6M9 11h6',
}

export const menuLateral = [
  { grupo: null,                 items: [{ label: 'Inicio', icon: 'inicio', activa: true }] },
  { grupo: 'Gestión académica',  items: [
    { label: 'Retos y proyectos', icon: 'capas' },
    { label: 'Encuentros',        icon: 'portapapeles' },
    { label: 'Mis grupos',        icon: 'grafica' },
    { label: 'Alumnado',          icon: 'alumnado' },
    { label: 'Empresas',          icon: 'empresa' },
  ] },
  { grupo: 'Organización',       items: [{ label: 'Calendario', icon: 'calendario' }, { label: 'Notificaciones', icon: 'campana' }] },
  { grupo: 'Ayuda',              items: [{ label: 'Recursos', icon: 'recursos' }] },
  { grupo: 'Administración',     items: [{ label: 'Usuarios', icon: 'usuarios' }] },
]

// Resumen del curso — mismos colores e iconos que InicioDocente.vue
export const kpis = [
  { label: 'Alumnos participantes',  valor: 647, tile: 'bg-alumnos',          num: 'text-[#B85E0A]', icon: 'alumnos' },
  { label: 'Empresas colaboradoras', valor: 29,  tile: 'bg-empresas',         num: 'text-[#3D7A1E]', icon: 'empresas' },
  { label: 'Proyectos completados',  valor: 108, tile: 'bg-administraciones', num: 'text-[#0F7273]', icon: 'proyecto' },
  { label: 'Encuentros realizados',  valor: 108, tile: 'bg-centros',          num: 'text-centros',   icon: 'encuentro' },
]

// Impacto acumulado (septiembre → junio), un valor acumulado por mes
export const MESES = ['Sep', 'Oct', 'Nov', 'Dic', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun']
export const impacto = [
  { corto: 'Alumnado',              color: '#FF8920', acum: [0, 98, 186, 214, 298, 408, 487, 607, 647, 647] },
  { corto: 'Proyectos completados', color: '#19A7A8', acum: [0, 8, 15, 19, 30, 44, 58, 76, 96, 108] },
  { corto: 'Empresas',              color: '#509928', acum: [0, 4, 7, 9, 12, 16, 19, 23, 27, 29] },
  { corto: 'Encuentros',            color: '#3072AA', acum: [0, 12, 23, 30, 45, 61, 74, 92, 106, 108] },
]
export const Y_MAX = 700

// Estado de los proyectos (donut): recorrido del borrador al cierre
export const estados = [
  { label: 'En edición',        valor: 12,  color: '#FF8920' },
  { label: 'Pendiente validar', valor: 18,  color: '#3072AA', detalle: '18 sin enviar' },
  { label: 'Validados',         valor: 47,  color: '#509928' },
  { label: 'Completados',       valor: 108, color: '#19A7A8' },
]

export const filtrosProyectos = [
  { label: 'Todos', n: 185 },
  { label: 'Validados', n: 47 },
  { label: 'Pendiente validar', n: 18 },
  { label: 'En edición', n: 12 },
  { label: 'Completados', n: 108, activo: true },
  { label: 'Archivado', n: 0 },
]

export const proyectos = [
  { titulo: 'Mejora de la Comunicación Interna',           meta: 'Gestión Avanza · Administración y Finanzas · 2º' },
  { titulo: 'Optimización de Comunicación Cliente-Equipo', meta: 'TecnoCom Innovación · Desarrollo de Aplicaciones Multiplataforma · 2º' },
  { titulo: 'Digitalización del archivo documental',       meta: 'RedTec Soluciones · Administración y Finanzas · 1º' },
  { titulo: 'Plan de marketing para comercio local',       meta: 'Gestión Avanza · Marketing y Publicidad · 2º' },
  { titulo: 'App de reservas para una pyme',               meta: 'TecnoCom Innovación · Desarrollo de Aplicaciones Web · 1º' },
]

export const herramientas = [
  { titulo: 'Generar proyecto',         icon: 'masCirculo',   tile: 'bg-centros' },
  { titulo: 'Biblioteca de proyectos',  icon: 'capas',        tile: 'bg-empresas' },
  { titulo: 'Crear encuentro',          icon: 'portapapeles', tile: 'bg-alumnos' },
  { titulo: 'Biblioteca de encuentros', icon: 'libro',        tile: 'bg-alumnos' },
]

export const proximosEncuentros = [
  { dia: 26, mes: 'OCT', titulo: 'Estrategia de formación continua',            meta: 'Administración y Finanzas · 2º · Clase A' },
  { dia: 9,  mes: 'NOV', titulo: 'Capacitación en nuevas herramientas digitales', meta: 'Desarrollo de Aplicaciones Web · 2º · Clase A' },
]

// Mini calendario: octubre de 2026 (el 1 cae en jueves → 3 días de septiembre delante)
export const calendario = {
  mes: 'Octubre de 2026',
  hoy: 20,
  conEncuentro: [5, 6, 26],
  celdas: (() => {
    const c = [28, 29, 30].map(d => ({ d, otroMes: true }))
    for (let d = 1; d <= 31; d++) c.push({ d })
    for (let d = 1; c.length < 42; d++) c.push({ d, otroMes: true })
    return c
  })(),
}

export const tareas = [
  { texto: 'Enviar 18 propuestas a la empresa',          hecha: false, alta: true },
  { texto: 'Retomar 6 proyectos parados hace +14 días',  hecha: false },
  { texto: 'Preparar rúbrica de la fase 2',              hecha: true },
]

export const empresas = [
  { ini: 'RS', nombre: 'RedTec Soluciones',   familia: 'Informática y Comunicaciones', proyectos: 17, validados: 15, color: 'bg-centros' },
  { ini: 'GA', nombre: 'Gestión Avanza',      familia: 'Administración y Gestión',     proyectos: 16, validados: 13, color: 'bg-empresas' },
  { ini: 'TI', nombre: 'TecnoCom Innovación', familia: 'Informática y Comunicaciones', proyectos: 14, validados: 13, color: 'bg-alumnos' },
]
