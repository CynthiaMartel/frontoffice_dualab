<template>
  <!-- "Tareas pendientes" de InicioDocente.vue: interruptores, paginación y campo para añadir -->
  <article class="min-w-0 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-gray-200/70">
    <div class="mb-3 flex items-center justify-between gap-2">
      <p class="font-heading text-base font-bold">Tareas pendientes</p>
      <span class="rounded-full bg-alumnos/15 px-2 py-0.5 text-xs font-bold text-[#B85E0A]">{{ tareas.filter(t => !t.hecha).length }}</span>
    </div>
    <ul class="space-y-0.5">
      <li v-for="t in tareas" :key="t.texto" class="flex h-11 items-center gap-2.5 px-1.5 text-sm">
        <span class="inline-flex h-4 w-[30px] shrink-0 items-center rounded-full p-0.5"
              :class="t.hecha ? 'bg-empresas' : t.alta ? 'bg-alumnos/30' : 'bg-gray-200'">
          <span class="h-3 w-3 rounded-full bg-white shadow" :class="t.hecha && 'translate-x-3.5'" />
        </span>
        <span class="min-w-0 flex-1 leading-snug" :class="t.hecha ? 'text-gray-400 line-through' : 'text-gray-700'">{{ t.texto }}</span>
      </li>
    </ul>
    <div class="mt-1 flex h-7 items-center justify-center gap-3 text-xs text-gray-400">‹ <span class="text-gray-500">1 / 1</span> ›</div>
    <div class="mt-2 flex gap-2">
      <span class="min-w-0 flex-1 truncate rounded-lg border border-gray-200 px-3 py-1.5 text-sm text-gray-400">Añadir tarea personal…</span>
      <span class="shrink-0 rounded-full bg-centros/10 px-3 py-1.5 text-sm font-semibold text-centros">Añadir</span>
    </div>
  </article>
</template>

<script setup>
import { tareas } from './panelDocenteDemo'
</script>
