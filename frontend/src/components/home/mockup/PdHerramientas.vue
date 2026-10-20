<template>
  <!-- "Herramientas" de InicioDocente.vue: botones tipo icono de app y barra con los colores del logo -->
  <article class="relative min-w-0 overflow-hidden rounded-2xl bg-gradient-to-br from-[#F6F9FD] to-white p-4 shadow-sm ring-1 ring-gray-200/70">
    <span class="absolute inset-x-0 top-0 flex h-1"><span class="flex-1 bg-centros" /><span class="flex-1 bg-empresas" /><span class="flex-1 bg-administraciones" /><span class="flex-1 bg-alumnos" /></span>
    <p class="mb-3 font-heading text-lg font-bold">Herramientas</p>
    <div class="grid grid-cols-2 gap-2">
      <div v-for="h in herramientas" :key="h.titulo"
           class="flex h-[118px] min-w-0 flex-col items-center justify-center gap-1.5 rounded-xl bg-white p-2 text-center ring-1 ring-gray-200/70">
        <span class="flex h-11 w-11 items-center justify-center rounded-xl text-white shadow-sm" :class="h.tile">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" :d="ICONOS[h.icon]"/></svg>
        </span>
        <span class="text-xs font-semibold leading-tight">{{ h.titulo }}</span>
      </div>
    </div>
  </article>
</template>

<script setup>
import { ICONOS, herramientas } from './panelDocenteDemo'
</script>
