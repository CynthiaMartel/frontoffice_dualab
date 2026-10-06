// Datos ficticios para la maqueta del panel docente (/panel-docente de la
// herramienta DuaLab) que se muestra en "Toda la gestión en un mismo lugar".
// Solo ilustrativos: no salen de la API.

export const docente = { nombre: 'María', centro: 'IES Sierra Norte' }

// Mismos cuatro contadores y colores que InicioDocente.vue
export const contadores = [
  { valor: 12, label: 'Validados',       cta: 'Ver todos →',       num: 'text-centros',    cta2: 'text-centros/60' },
  { valor: 3,  label: 'Pendientes',      cta: 'Ver todos →',       num: 'text-amber-500',  cta2: 'text-amber-400/60' },
  { valor: 18, label: 'Total proyectos', cta: 'Ver todos →',       num: 'text-blue-500',   cta2: 'text-blue-400/60' },
  { valor: 9,  label: 'Encuentros',      cta: 'Ver encuentros →',  num: 'text-purple-500', cta2: 'text-purple-400/60' },
]

export const encuentros = [
  { titulo: 'Optimización del archivo documental', fecha: '8 oct 2026',  curso: '1º GA',  grupo: 'A', alumnos: 24 },
  { titulo: 'Plan de marketing para comercio local', fecha: '14 oct 2026', curso: '2º MyP', grupo: 'B', alumnos: 18 },
  { titulo: 'App de reservas para una pyme',        fecha: '21 oct 2026', curso: '1º DAW', grupo: 'A', alumnos: 22 },
]

export const alertas = [
  { nivel: 'warning', texto: '3 propuestas de proyecto pendientes de validar' },
  { nivel: 'info',    texto: 'Encuentro «Archivo documental» en 2 días' },
  { nivel: 'success', texto: 'El equipo Innova entregó la fase 3' },
]

export const notas = [
  'Revisar entregables del grupo B',
  'Llamar a la empresa colaboradora',
  'Preparar rúbrica de la fase 2',
]

// Calendario: octubre de 2026 (el 1 cae en jueves → 3 huecos con semana L–D)
export const calendario = {
  mes: 'octubre 2026',
  huecos: 3,
  dias: 31,
  hoy: 6,
  eventos: {
    8:  [{ texto: 'Archivo documental', clase: 'bg-blue-500' }],
    12: [{ texto: 'Festivo', clase: 'bg-rose-400' }],
    14: [{ texto: 'Marketing local', clase: 'bg-blue-500' }],
    19: [{ texto: 'Tutoría empresa', clase: 'bg-emerald-500' }],
    21: [{ texto: 'App reservas', clase: 'bg-blue-500' }],
    28: [{ texto: 'Evaluación', clase: 'bg-amber-400' }],
  },
}

// Donut "Progreso de proyectos" (r = 38 → circunferencia ≈ 238.76)
export const DONUT_C = 2 * Math.PI * 38
const segmentos = [
  { label: 'Validados',  valor: 12, color: '#3072AA' },
  { label: 'Pendientes', valor: 3,  color: '#F59E0B' },
  { label: 'En edición', valor: 3,  color: '#9CA3AF' },
]
const total = segmentos.reduce((s, x) => s + x.valor, 0)
let acumulado = 0
export const donut = segmentos.map((s) => {
  const dash = (s.valor / total) * DONUT_C
  const seg = { ...s, dash, rotacion: (acumulado / DONUT_C) * 360 }
  acumulado += dash
  return seg
})
export const donutTotal = total

export const menuLateral = [
  { grupo: null, items: ['Panel docente'] },
  { grupo: 'Retos',                  num: 1, items: ['Generador Retos', 'Biblioteca Retos'] },
  { grupo: 'Taller de Ideas',        num: 2, items: ['Generar Proyecto', 'Biblioteca Proyectos'] },
  { grupo: 'Encuentro con alumnado', num: 3, items: ['Generar encuentros', 'Biblioteca de encuentros', 'Dar acceso al encuentro', 'Seguimiento de mis equipos'] },
]
