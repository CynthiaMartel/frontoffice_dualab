<template>
  <div class="relative">
    <!-- Órbitas decorativas (solo desktop): dos anillos punteados alrededor del logo -->
    <div class="hidden md:block absolute inset-0 pointer-events-none" aria-hidden="true">
      <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] rounded-full border border-dashed border-primary-200" />
      <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[260px] h-[260px] rounded-full border border-dashed border-primary-200" />
      <span v-for="d in dots" :key="d" class="absolute w-2 h-2 rounded-full bg-primary-200" :class="d" />
    </div>

    <div class="relative grid grid-cols-2 md:grid-cols-[1fr_auto_1fr] md:grid-rows-2 gap-x-6 gap-y-10 md:gap-y-24 items-center">
      <!-- Centro: logo DuaLab -->
      <div class="col-span-2 md:col-span-1 md:col-start-2 md:row-start-1 md:row-span-2 flex flex-col items-center justify-center md:px-6">
        <img src="@/assets/logo_colores.png" alt="" class="w-24 md:w-28 object-contain" />
        <span class="font-heading font-extrabold tracking-tight text-azul-noche text-2xl md:text-3xl leading-none mt-1">DuaLab</span>
      </div>

      <div
        v-for="a in agents"
        :key="a.key"
        class="flex flex-col items-center text-center gap-3 md:gap-4"
        :class="[a.position, a.side === 'left' ? 'md:flex-row-reverse md:text-right' : 'md:flex-row md:text-left']"
      >
        <div
          class="w-16 h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center text-white shrink-0 shadow-[0_8px_20px_rgba(23,40,62,0.15)] ring-4 ring-white"
          :class="a.bg"
        >
          <component :is="a.icon" class="w-8 h-8 md:w-10 md:h-10" />
        </div>
        <div class="max-w-[190px]">
          <h3 class="font-heading font-extrabold text-xs md:text-sm uppercase tracking-wide" :class="a.text">{{ a.label }}</h3>
          <p class="text-xs md:text-sm text-gray-500 leading-snug mt-1">{{ a.desc }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import {
  AcademicCapIcon,
  BuildingOffice2Icon,
  UserGroupIcon,
  BuildingLibraryIcon,
} from '@heroicons/vue/24/outline'

// Clases literales (no construidas a partir de `key`) para que Tailwind las detecte.
const agents = [
  {
    key: 'centros', label: 'Centros Educativos', side: 'left',
    desc: 'Gestionan, coordinan y potencian la FP Dual',
    icon: AcademicCapIcon, bg: 'bg-centros', text: 'text-centros',
    position: 'md:col-start-1 md:row-start-1',
  },
  {
    key: 'empresas', label: 'Empresas', side: 'right',
    desc: 'Apoyan el talento y colaboran en proyectos reales',
    icon: BuildingOffice2Icon, bg: 'bg-empresas', text: 'text-empresas',
    position: 'md:col-start-3 md:row-start-1',
  },
  {
    key: 'alumnado', label: 'Alumnado', side: 'left',
    desc: 'Desarrolla su talento en entornos profesionales',
    icon: UserGroupIcon, bg: 'bg-alumnos', text: 'text-alumnos',
    position: 'md:col-start-1 md:row-start-2',
  },
  {
    key: 'administraciones', label: 'Administraciones', side: 'right',
    desc: 'Impulsan y hacen crecer la Formación Dual',
    icon: BuildingLibraryIcon, bg: 'bg-administraciones', text: 'text-administraciones',
    position: 'md:col-start-3 md:row-start-2',
  },
]

const dots = [
  'left-[50%] top-[2%]',
  'left-[30%] top-[22%]',
  'right-[28%] bottom-[18%]',
  'left-[46%] bottom-[4%]',
]
</script>
