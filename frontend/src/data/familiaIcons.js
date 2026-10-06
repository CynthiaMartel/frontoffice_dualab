// Icono por familia profesional (por nombre, que es lo que devuelve la API).
// Compartido por la home y /familias.
import {
  BriefcaseIcon,
  PresentationChartBarIcon,
  ComputerDesktopIcon,
  HeartIcon,
  GlobeEuropeAfricaIcon,
  BoltIcon,
  BookOpenIcon,
} from '@heroicons/vue/24/outline'

const FAMILIA_ICONS = {
  'Administración y Gestión':     BriefcaseIcon,
  'Comercio y Marketing':         PresentationChartBarIcon,
  'Informática y Comunicaciones': ComputerDesktopIcon,
  'Sanidad':                      HeartIcon,
  'Hostelería y Turismo':         GlobeEuropeAfricaIcon,
  'Electricidad y Electrónica':   BoltIcon,
}

export function familiaIcon(nombre) {
  return FAMILIA_ICONS[nombre] ?? BookOpenIcon
}
