<template>
  <!-- "Proyectos" de InicioDocente.vue: filtros de estado + lista (filtro Completados) -->
  <article class="min-w-0 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-gray-200/70">
    <div class="mb-3 flex items-center justify-between gap-3">
      <p class="font-heading text-lg font-bold">Proyectos</p>
      <span class="shrink-0 text-sm font-semibold text-centros">Ver todos</span>
    </div>
    <div class="mb-3 flex gap-1.5 overflow-hidden">
      <span v-for="f in filtrosProyectos" :key="f.label"
            class="flex shrink-0 items-center gap-1.5 whitespace-nowrap rounded-full border px-3 py-1 text-xs font-semibold"
            :class="f.activo ? 'border-centros bg-centros text-white' : 'border-gray-200 bg-white text-gray-600'">
        {{ f.label }}
        <span class="rounded-full px-1.5 text-[10px]" :class="f.activo ? 'bg-white/20' : 'bg-gray-100 text-gray-500'">{{ f.n }}</span>
      </span>
    </div>
    <ul class="divide-y divide-gray-100">
      <li v-for="p in proyectos" :key="p.titulo" class="flex h-16 items-center gap-3">
        <div class="flex h-10 w-12 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-centros/15 to-administraciones/15 text-centros">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" :d="ICONOS.capas"/></svg>
        </div>
        <div class="min-w-0 flex-1">
          <p class="truncate text-sm font-semibold">{{ p.titulo }}</p>
          <p class="truncate text-xs text-gray-500">{{ p.meta }}</p>
          <!-- En tarjetas estrechas la etiqueta baja bajo el título, como en la herramienta -->
          <span v-if="compacto" class="mt-0.5 inline-block rounded-full border border-sky-300 bg-sky-50 px-2 py-px text-[10px] font-bold text-sky-700">Completado</span>
        </div>
        <span v-if="!compacto" class="shrink-0 rounded-full border border-sky-300 bg-sky-50 px-2.5 py-0.5 text-[11px] font-bold text-sky-700">Completado</span>
      </li>
    </ul>
  </article>
</template>

<script setup>
import { ICONOS, filtrosProyectos, proyectos } from './panelDocenteDemo'

defineProps({ compacto: Boolean })
</script>
