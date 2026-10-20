<template>
  <!-- Bienvenida de InicioDocente.vue: saludo y botones a la izquierda; foto real con
       cintas de los colores del logo y nota manuscrita a la derecha. En móvil, la foto
       va arriba y el texto debajo (igual que la herramienta en pantallas estrechas). -->
  <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#E4EEF9] via-[#EDF3FA] to-transparent"
           :class="compacto ? '' : 'min-h-[230px]'">
    <div :class="compacto
      ? 'relative h-36'
      : 'absolute inset-y-0 right-0 w-[52%] [mask-image:linear-gradient(to_right,black_82%,transparent)]'">
      <img src="@/assets/1_dua.jpeg" alt=""
           class="absolute inset-0 h-full w-full object-cover object-[60%_50%]"
           :class="!compacto && '[mask-image:linear-gradient(to_left,black_35%,rgba(0,0,0,0.3))]'" />
      <svg class="absolute inset-0 h-full w-full" viewBox="0 0 1000 300" preserveAspectRatio="none">
        <defs>
          <linearGradient :id="`${id}-azul`" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#2F7FD8" /><stop offset="100%" stop-color="#1E5FB8" /></linearGradient>
          <linearGradient :id="`${id}-azul-claro`" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#9BD3F7" /><stop offset="100%" stop-color="#4FA3E8" /></linearGradient>
          <linearGradient :id="`${id}-naranja`" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#FFB45C" /><stop offset="45%" stop-color="#FF8920" /><stop offset="100%" stop-color="#F57A0E" /></linearGradient>
          <linearGradient :id="`${id}-melocoton`" x1="0" y1="0" x2="1" y2="0"><stop offset="0%" stop-color="#FFC48A" stop-opacity="0.85" /><stop offset="100%" stop-color="#FFE6CC" stop-opacity="0.15" /></linearGradient>
          <linearGradient :id="`${id}-verde`" x1="1" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#3D8A22" /><stop offset="100%" stop-color="#6EC13F" /></linearGradient>
          <linearGradient :id="`${id}-turquesa`" x1="0" y1="1" x2="1" y2="0"><stop offset="0%" stop-color="#4CC7D6" /><stop offset="100%" stop-color="#19A7A8" /></linearGradient>
          <linearGradient :id="`${id}-cian`" x1="0" y1="1" x2="1" y2="0"><stop offset="0%" stop-color="#9BE7EF" stop-opacity="0.9" /><stop offset="100%" stop-color="#6FD6E3" stop-opacity="0.75" /></linearGradient>
        </defs>
        <path d="M0,0 L40,0 C52,46 70,82 96,118 C60,112 26,108 6,103 C0,70 0,30 0,0 Z" :fill="`url(#${id}-azul-claro)`" opacity="0.9" />
        <path d="M40,0 L76,0 C98,46 140,104 222,202 C160,168 120,140 96,118 C70,82 52,46 40,0 Z" :fill="`url(#${id}-azul)`" />
        <path d="M240,192 C330,208 435,228 540,256 L560,300 L300,300 C285,262 265,222 240,192 Z" :fill="`url(#${id}-melocoton)`" />
        <path d="M0,72 C60,100 150,150 240,192 C275,212 305,238 332,262 L300,300 L0,300 Z" :fill="`url(#${id}-naranja)`" />
        <path d="M110,185 C165,220 230,258 300,300 L262,300 C200,265 150,232 110,185 Z" fill="#FFFFFF" opacity="0.35" />
        <path d="M836,0 L870,0 C852,80 822,150 780,206 C800,140 822,70 836,0 Z" fill="#8BD45F" opacity="0.9" />
        <path d="M870,0 L1000,0 L1000,40 C958,100 880,170 780,206 C822,150 852,80 870,0 Z" :fill="`url(#${id}-verde)`" />
        <path d="M500,300 C620,252 760,200 900,112 C940,86 970,64 1000,46 L1000,68 C900,128 780,222 546,300 Z" :fill="`url(#${id}-cian)`" />
        <path d="M546,300 C700,242 800,190 900,128 C940,102 975,82 1000,68 L1000,300 Z" :fill="`url(#${id}-turquesa)`" />
        <path d="M600,300 C700,268 790,228 870,178" fill="none" stroke="#FFFFFF" stroke-opacity="0.45" stroke-width="2" vector-effect="non-scaling-stroke" />
        <path d="M720,300 C830,270 925,222 1000,165 L1000,300 Z" fill="#138C9C" opacity="0.55" />
      </svg>
      <div v-if="compacto" class="absolute inset-x-0 bottom-0 flex h-1.5"><span class="flex-1 bg-centros" /><span class="flex-1 bg-empresas" /><span class="flex-1 bg-administraciones" /><span class="flex-1 bg-alumnos" /></div>
    </div>

    <!-- Nota manuscrita -->
    <div v-if="!compacto" class="absolute right-6 top-4 z-10 -rotate-6">
      <p class="font-hand text-2xl leading-6 text-white [text-shadow:0_1px_3px_rgba(23,40,62,0.75)]">Ideas de hoy<br />para el mundo<br />de mañana</p>
      <svg class="ml-10 mt-1 h-8 w-14 -scale-x-100 text-alumnos drop-shadow" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" viewBox="0 0 56 32">
        <path d="M2,4 C10,22 30,28 50,20" /><path d="M42,14 L51,20 L42,26" />
      </svg>
    </div>

    <div class="relative z-10 p-5" :class="!compacto && 'max-w-[46%]'">
      <p class="font-heading font-bold tracking-tight text-azul-noche" :class="compacto ? 'text-2xl' : 'text-3xl'">¡Hola, {{ usuario.nombre }}!</p>
      <p class="mt-1 font-heading font-bold leading-snug text-azul-noche" :class="compacto ? 'text-lg' : 'text-xl'">
        Seguimos conectando talento<br v-if="!compacto" /> con <span class="text-centros">oportunidades reales</span>
      </p>
      <p class="mt-2 text-sm text-gray-600">
        Desde aquí puedes gestionar la Formación Dual de DuaLab, impulsar la colaboración con empresas y seguir el progreso de tu alumnado.
      </p>
      <div class="mt-3 flex flex-wrap gap-2">
        <span class="flex h-10 items-center gap-2 whitespace-nowrap rounded-full bg-centros px-4 text-sm font-semibold text-white shadow-md shadow-centros/25">
          <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
          Nuevo proyecto
        </span>
        <span class="flex h-10 items-center gap-2 whitespace-nowrap rounded-full border border-centros/30 bg-white px-4 text-sm font-semibold text-centros shadow-sm">
          <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
          Nuevo encuentro
        </span>
      </div>
    </div>
  </section>
</template>

<script>
// Ids de degradado únicos: portátil y móvil pintan la bienvenida a la vez en la misma página
let siguienteId = 0
</script>

<script setup>
import { usuario } from './panelDocenteDemo'

defineProps({ compacto: Boolean })
const id = `pd-bv-${siguienteId++}`
</script>
