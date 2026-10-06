<template>
  <!-- Cabecera de bienvenida de InicioDocente.vue -->
  <div class="relative overflow-hidden bg-[#1F2937] rounded-2xl" :class="movil ? 'p-4' : 'p-5'">
    <div class="absolute top-0 right-0 w-48 h-48 bg-centros/10 rounded-full translate-x-1/3 -translate-y-1/3 blur-[60px]"></div>
    <div class="relative z-10 flex items-center justify-between gap-3">
      <div class="flex items-center gap-3">
        <img v-if="!movil" src="@/assets/logo_colores.png" alt="" class="h-24 w-24 object-contain shrink-0" />
        <div>
          <div class="inline-flex items-center gap-1.5 bg-centros/15 border border-centros/25 rounded-full px-2.5 py-0.5 mb-2">
            <span class="w-1.5 h-1.5 rounded-full bg-primary-400 shrink-0"></span>
            <span class="text-primary-400 text-[9px] font-black uppercase tracking-widest">Perfil docente</span>
          </div>
          <p class="font-black text-white tracking-tight" :class="movil ? 'text-lg' : 'text-xl'">
            Bienvenido/a, <span class="text-primary-400">{{ docente.nombre }}</span>
          </p>
          <div class="flex items-center gap-1.5 mt-1">
            <svg class="w-3.5 h-3.5 text-white/40 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            <span class="text-white/55 text-xs font-semibold">{{ docente.centro }}</span>
          </div>
          <p class="text-white/35 text-xs mt-0.5 font-medium">Panel de control · DuaLab</p>
        </div>
      </div>
      <div v-if="!movil" class="flex w-11 h-11 rounded-xl bg-centros/15 border border-centros/25 items-center justify-center shrink-0">
        <svg class="w-5 h-5 text-centros" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
      </div>
    </div>
  </div>
</template>

<script setup>
import { docente } from './panelDocenteDemo'

defineProps({ movil: Boolean })
</script>
