<template>
  <!-- "Próximos encuentros" + mini calendario de InicioDocente.vue (misma tarjeta) -->
  <article class="flex min-w-0 flex-col rounded-2xl bg-white p-4 shadow-sm ring-1 ring-gray-200/70">
    <div class="mb-3 flex items-center justify-between gap-3">
      <p class="font-heading text-lg font-bold leading-snug text-azul-noche">Próximos encuentros</p>
      <span class="shrink-0 text-sm font-semibold text-centros">Ver todos</span>
    </div>
    <ul class="space-y-1.5">
      <li v-for="e in proximosEncuentros" :key="e.titulo" class="flex h-[41px] items-center gap-2.5 px-1">
        <span class="flex h-8 w-8 shrink-0 flex-col items-center justify-center rounded-lg bg-centros/10 ring-1 ring-centros/15">
          <span class="font-heading text-sm font-bold leading-none">{{ e.dia }}</span>
          <span class="text-[9px] font-semibold leading-tight text-gray-500">{{ e.mes }}</span>
        </span>
        <span class="min-w-0 flex-1">
          <span class="block truncate text-[13px] font-semibold leading-tight">{{ e.titulo }}</span>
          <span class="block truncate text-[11px] leading-tight text-gray-500">{{ e.meta }}</span>
        </span>
        <svg class="h-4 w-4 shrink-0 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </li>
    </ul>
    <div class="mt-3 border-t border-gray-100 pt-2">
      <div class="mb-1 flex items-center justify-between text-gray-500">
        <svg class="h-4 w-4 mx-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        <p class="text-sm font-semibold text-azul-noche">{{ calendario.mes }}</p>
        <svg class="h-4 w-4 mx-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </div>
      <div class="grid grid-cols-7 text-center text-[10px] font-semibold uppercase text-gray-400">
        <span v-for="d in ['L', 'M', 'X', 'J', 'V', 'S', 'D']" :key="d" class="py-0.5">{{ d }}</span>
      </div>
      <div class="grid grid-cols-7">
        <span v-for="(c, i) in calendario.celdas" :key="i"
              class="mx-auto flex h-5 w-5 items-center justify-center rounded-full text-[10px]"
              :class="c.otroMes ? 'text-[11px] text-gray-300'
                : c.d === calendario.hoy ? 'bg-alumnos font-bold text-white'
                : calendario.conEncuentro.includes(c.d) ? 'font-bold text-centros'
                : 'text-gray-600'">{{ c.d }}</span>
      </div>
      <div class="mt-1 flex h-8 items-center justify-center gap-x-4 text-[11px] text-gray-500">
        <span class="flex items-center gap-1.5"><span class="font-bold leading-none text-centros">14</span>Encuentro</span>
        <span class="flex items-center gap-1.5"><span class="h-3 w-3 rounded-full bg-alumnos" />Hoy</span>
        <span class="flex items-center gap-1.5"><span class="h-3 w-3 rounded-full bg-white ring-1 ring-gray-300" />Libre</span>
      </div>
    </div>
  </article>
</template>

<script setup>
import { proximosEncuentros, calendario } from './panelDocenteDemo'
</script>
