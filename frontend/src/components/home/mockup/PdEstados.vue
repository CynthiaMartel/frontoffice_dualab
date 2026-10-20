<template>
  <!-- "Estado de los proyectos" de InicioDocente.vue: donut + leyenda en forma de recorrido -->
  <article class="flex h-full min-w-0 flex-col rounded-2xl bg-white p-4 shadow-sm ring-1 ring-gray-200/70">
    <div class="mb-4 flex items-center justify-between gap-3">
      <p class="font-heading text-lg font-bold text-azul-noche">Estado de los proyectos</p>
      <span class="shrink-0 text-sm font-semibold text-centros">Ver todos</span>
    </div>
    <div class="flex flex-1 items-center justify-center gap-4">
      <div class="relative h-36 w-36 shrink-0">
        <svg viewBox="0 0 140 140" class="h-full w-full -rotate-90">
          <circle cx="70" cy="70" :r="R" fill="none" stroke="#F3F4F6" stroke-width="18" />
          <circle v-for="s in segmentos" :key="s.label" cx="70" cy="70" :r="R" fill="none" :stroke="s.color" stroke-width="18"
                  :stroke-dasharray="`${s.dash} ${CIRC}`" :stroke-dashoffset="s.offset" />
        </svg>
        <div class="absolute inset-0 flex flex-col items-center justify-center">
          <span class="font-heading text-2xl font-bold">{{ total }}</span>
          <span class="text-[11px] text-gray-500">proyectos</span>
        </div>
      </div>
      <ol class="relative min-w-0 flex-1">
        <span class="absolute bottom-3 left-[11px] top-3 w-px bg-gray-200" />
        <li v-for="s in segmentos" :key="s.label" class="relative flex items-start gap-2.5 px-1.5 py-1">
          <span class="relative z-10 mt-1 h-2.5 w-2.5 shrink-0 rounded-full ring-4 ring-white" :style="{ background: s.color }" />
          <span class="min-w-0">
            <span class="block truncate text-xs font-medium text-gray-700">{{ s.label }}</span>
            <span class="block truncate text-[11px] text-gray-500"><strong class="text-azul-noche">{{ s.valor }}</strong> ({{ s.pct }}%)<template v-if="s.detalle"> · {{ s.detalle }}</template></span>
          </span>
        </li>
      </ol>
    </div>
  </article>
</template>

<script setup>
import { estados } from './panelDocenteDemo'

const R = 54
const CIRC = 2 * Math.PI * R
const total = estados.reduce((s, e) => s + e.valor, 0)
let acum = 0
const segmentos = estados.map(e => {
  const len = (e.valor / total) * CIRC
  const seg = { ...e, pct: Math.round((e.valor / total) * 100), dash: Math.max(len - 2, 0), offset: -acum }
  acum += len
  return seg
})
</script>
