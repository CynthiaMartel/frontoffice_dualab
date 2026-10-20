<template>
  <!-- "Resumen del curso" de InicioDocente.vue: selector de curso + 4 contadores -->
  <section class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-gray-200/70">
    <div class="mb-3 flex items-center justify-between gap-2">
      <p class="font-heading text-lg font-bold text-azul-noche">Resumen del curso</p>
      <span class="flex shrink-0 items-center gap-2 whitespace-nowrap rounded-lg border border-gray-200 bg-white font-medium" :class="compacto ? 'h-8 px-2.5 text-xs' : 'h-9 px-3 text-sm'">
        Curso 2025/2026
        <svg class="h-3.5 w-3.5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
      </span>
    </div>
    <div class="grid gap-3" :class="compacto ? 'grid-cols-2' : 'grid-cols-4'">
      <div v-for="k in kpis" :key="k.label" class="min-w-0 rounded-xl p-2.5 ring-1 ring-gray-200/70">
        <div class="flex items-center" :class="compacto ? 'gap-2.5' : 'gap-3'">
          <div class="flex shrink-0 items-center justify-center text-white shadow-sm" :class="[k.tile, compacto ? 'h-11 w-11 rounded-xl' : 'h-12 w-12 rounded-2xl']">
            <svg v-if="k.icon === 'alumnos'" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            <svg v-else-if="k.icon === 'empresas'" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 21V5a2 2 0 012-2h8a2 2 0 012 2v16M16 9h2a2 2 0 012 2v10M2 21h20M8 7h4M8 11h4M8 15h4"/></svg>
            <svg v-else-if="k.icon === 'encuentro'" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path stroke-linecap="round" d="M16 2v4M8 2v4M3 10h18M8 15h3"/></svg>
            <svg v-else class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
          </div>
          <div class="min-w-0">
            <p class="font-medium leading-snug text-gray-600" :class="compacto ? 'text-xs' : 'text-sm'">{{ k.label }}</p>
            <p class="mt-1 font-heading text-2xl font-bold leading-none" :class="k.num">{{ k.valor }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { kpis } from './panelDocenteDemo'

defineProps({ compacto: Boolean })
</script>
