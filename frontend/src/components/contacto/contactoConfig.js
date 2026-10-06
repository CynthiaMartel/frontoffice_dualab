// Contenido de /contacto por agente (textos y estructura de los diseños
// "FORMULARIO CENTROS/EMPRESAS/ALUMNOS/ADMINISTRACIONES").
import {
  AcademicCapIcon,
  BuildingOffice2Icon,
  UserGroupIcon,
  BuildingLibraryIcon,
  Cog6ToothIcon,
  LightBulbIcon,
  ChartBarIcon,
  GlobeEuropeAfricaIcon,
  BriefcaseIcon,
} from '@heroicons/vue/24/outline'
import centroEducativo from '@/assets/centro_educativo.jpg'
import dua25 from '@/assets/dua_25.jpg'
import dua4 from '@/assets/4_dua.jpeg'
import dua31 from '@/assets/dua_31.jpg'

// Clases literales por agente (Tailwind tiene que poder detectarlas).
export const AGENTES = {
  centro: {
    label: 'Centro educativo',
    icon: AcademicCapIcon,
    text: 'text-centros', bg: 'bg-centros', soft: 'bg-centros/10', border: 'border-centros', ring: 'ring-centros/20',
    titulo: [{ t: 'Únete a DuaLab' }, { t: 'y transforma la Formación Dual', color: true }],
    intro: 'Rellena el formulario y nuestro equipo se pondrá en contacto contigo para ayudarte a empezar.',
    beneficios: [
      { icon: UserGroupIcon, titulo: 'Te asesoramos', desc: 'Te orientamos según las necesidades de tu centro.' },
      { icon: Cog6ToothIcon, titulo: 'Te acompañamos', desc: 'En el proceso de registro e implantación.' },
      { icon: LightBulbIcon, titulo: 'Sin compromiso', desc: 'Conoce DuaLab y cómo puede ayudaros.' },
    ],
    imagen: centroEducativo,
    rotulo: ['Un ecosistema', 'que genera', 'oportunidades'],
    registro: 'Registrarme como centro',
    pasos: ['Tipo de organización', 'Tus datos', 'Centro educativo', 'Confirmación'],
  },
  empresa: {
    label: 'Empresa',
    icon: BuildingOffice2Icon,
    text: 'text-empresas', bg: 'bg-empresas', soft: 'bg-empresas/10', border: 'border-empresas', ring: 'ring-empresas/20',
    titulo: [{ t: 'Colabora con DuaLab' }, { t: 'y conecta con el talento', color: true }, { t: 'del futuro' }],
    intro: 'Rellena el formulario y nuestro equipo se pondrá en contacto contigo para explicarte cómo tu empresa puede participar en retos reales, acceder a talento cualificado y colaborar con centros educativos.',
    beneficios: [
      { icon: UserGroupIcon, titulo: 'Accede a talento cualificado', desc: 'Conecta con alumnado motivado y preparado.' },
      { icon: Cog6ToothIcon, titulo: 'Plantea retos y proyectos', desc: 'Aporta desafíos reales y genera soluciones.' },
      { icon: LightBulbIcon, titulo: 'Impulsa la innovación', desc: 'Contribuye al desarrollo de la FP Dual y fortalece tu marca empleadora.' },
    ],
    imagen: dua25,
    rotulo: ['Empresas', 'que apuestan', 'por el talento'],
    registro: 'Registrarme como empresa',
    pasos: ['Tipo de organización', 'Tus datos', 'Empresa', 'Confirmación'],
  },
  alumno: {
    label: 'Alumno/a',
    // Bloqueado de momento: la tarjeta se ve pero no se puede elegir, y
    // ?tipo=alumno abre el formulario de centro. Quitar para activarlo.
    bloqueado: true,
    icon: UserGroupIcon,
    text: 'text-alumnos', bg: 'bg-alumnos', soft: 'bg-alumnos/10', border: 'border-alumnos', ring: 'ring-alumnos/20',
    titulo: [{ t: 'Tu talento' }, { t: 'también impulsa', color: true }, { t: 'el futuro' }],
    intro: 'Rellena el formulario y comienza tu experiencia en DuaLab. Te ayudamos a encontrar prácticas, participar en retos y conectar con empresas para desarrollar tu talento.',
    beneficios: [
      { icon: BriefcaseIcon, titulo: 'Encuentra prácticas', desc: 'Accede a oportunidades reales en empresas.' },
      { icon: LightBulbIcon, titulo: 'Participa en retos', desc: 'Desarrolla tus competencias y gana experiencia.' },
      { icon: UserGroupIcon, titulo: 'Conecta con empresas', desc: 'Da el primer paso hacia tu futuro profesional.' },
    ],
    imagen: dua4,
    rotulo: ['Ideas de hoy', 'para el mundo', 'de mañana'],
    registro: 'Registrarme como alumno/a',
    pasos: ['Tipo de organización', 'Tus datos', 'Información académica', 'Intereses', 'Confirmación'],
  },
  administracion: {
    label: 'Entidad / Administración',
    icon: BuildingLibraryIcon,
    text: 'text-administraciones', bg: 'bg-administraciones', soft: 'bg-administraciones/10', border: 'border-administraciones', ring: 'ring-administraciones/20',
    titulo: [{ t: 'Impulsa la' }, { t: 'Formación Dual', color: true }, { t: 'en tu territorio' }],
    intro: 'Rellena el formulario y nuestro equipo se pondrá en contacto contigo para informarte sobre cómo DuaLab puede apoyar la gestión de programas, fomentar la colaboración entre centros y empresas y generar un mayor impacto en la Formación Dual.',
    beneficios: [
      { icon: ChartBarIcon, titulo: 'Gestión y seguimiento', desc: 'Herramientas para la monitorización del impacto.' },
      { icon: UserGroupIcon, titulo: 'Colaboración entre agentes', desc: 'Conecta centros, empresas y alumnado.' },
      { icon: GlobeEuropeAfricaIcon, titulo: 'Programas con impacto real', desc: 'Fomenta el talento y el desarrollo territorial.' },
    ],
    imagen: dua31,
    rotulo: ['Una FP Dual', 'que genera oportunidades', 'en tu territorio'],
    registro: 'Registrarme como entidad',
    pasos: ['Tipo de organización', 'Tus datos', 'Información institucional', 'Intereses', 'Confirmación'],
  },
}

export const TIPOS = Object.keys(AGENTES)
