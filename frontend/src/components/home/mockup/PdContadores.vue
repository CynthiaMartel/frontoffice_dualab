<template>
  <!-- Contadores de proyectos de InicioDocente.vue -->
  <div class="grid gap-3" :class="movil ? 'grid-cols-2' : 'grid-cols-4'">
    <div v-for="c in contadores" :key="c.label" class="bg-white border border-gray-100 rounded-2xl px-4 py-3">
      <div class="text-2xl font-black tabular-nums leading-none mb-1" :class="c.num">{{ c.valor }}</div>
      <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-tight">{{ c.label }}</p>
      <p class="text-[9px] font-black uppercase tracking-widest mt-1" :class="c.cta2">{{ c.cta }}</p>
    </div>
  </div>
</template>

<script setup>
import { contadores } from './panelDocenteDemo'

defineProps({ movil: Boolean })
</script>
