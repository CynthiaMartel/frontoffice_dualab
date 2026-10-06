<template>
  <!-- Copia de TopBar.vue (herramienta DuaLab) con sesión de docente -->
  <header class="h-16 flex items-center gap-2 px-3 bg-azul-noche border-b border-[#2C3F57] shrink-0">
    <span v-if="movil" class="w-10 h-10 rounded-lg flex items-center justify-center text-white/60 shrink-0">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </span>
    <span class="flex items-center gap-2 mr-1 shrink-0">
      <img src="@/assets/logo_colores.png" alt="" class="h-11 w-auto object-contain" />
      <span class="font-black text-lg tracking-tighter text-white uppercase">Dua<span class="text-primary-400">Lab</span></span>
    </span>
    <template v-if="!movil">
      <span class="text-white/15">/</span>
      <span class="text-[11px] font-black uppercase tracking-[0.15em] text-white/50">Panel docente</span>
    </template>
    <div class="flex-1" />
    <div v-if="!movil" class="flex flex-col items-end leading-none gap-0.5">
      <span class="text-[9px] font-black uppercase tracking-widest text-primary-400">Docente</span>
      <span class="text-[11px] font-bold text-white/70">{{ docente.nombre }} Pérez</span>
    </div>
    <span class="w-10 h-10 rounded-xl flex items-center justify-center text-white/40 shrink-0">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
    </span>
    <span class="w-10 h-10 rounded-xl flex items-center justify-center text-red-400/60 shrink-0">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
    </span>
  </header>
</template>

<script setup>
import { docente } from './panelDocenteDemo'

defineProps({ movil: Boolean })
</script>
