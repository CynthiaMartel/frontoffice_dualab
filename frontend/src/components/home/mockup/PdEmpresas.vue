<template>
  <!-- "Empresas colaboradoras" de InicioDocente.vue: top 3 + acceso al catálogo -->
  <article class="min-w-0 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-gray-200/70">
    <div class="mb-3 flex items-center justify-between gap-3">
      <p class="font-heading text-base font-bold">Empresas colaboradoras</p>
      <span class="shrink-0 text-sm font-semibold text-centros">Ver todas</span>
    </div>
    <ul class="mb-3 divide-y divide-gray-100">
      <li v-for="e in empresas" :key="e.nombre" class="flex items-center gap-3 py-2">
        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg font-heading text-xs font-bold text-white" :class="e.color">{{ e.ini }}</span>
        <div class="min-w-0 flex-1">
          <p class="truncate text-sm font-semibold">{{ e.nombre }}</p>
          <p class="truncate text-xs text-gray-500">{{ e.familia }}</p>
        </div>
        <span class="shrink-0 text-right text-xs leading-snug text-gray-500">{{ e.proyectos }} proyectos<br />{{ e.validados }} validados</span>
      </li>
    </ul>
    <div class="flex items-center justify-between gap-2 rounded-xl bg-empresas/5 p-2.5 text-sm ring-1 ring-empresas/15">
      <span class="min-w-0"><span class="block font-semibold">Catálogo de empresas</span><span class="block text-xs text-gray-500">Encuentra empresas para tus próximos retos</span></span>
      <span class="shrink-0 font-semibold text-[#3D7A1E]">Ir →</span>
    </div>
  </article>
</template>

<script setup>
import { empresas } from './panelDocenteDemo'
</script>
