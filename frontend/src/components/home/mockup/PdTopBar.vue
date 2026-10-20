<template>
  <!-- Copia de TopBar.vue (herramienta DuaLab): logo, "Conoce DUALAB" y menú de usuario -->
  <header class="h-16 flex items-center gap-2 px-3 bg-azul-noche border-b border-[#2C3F57] shrink-0">
    <span v-if="hamburguesa" class="w-10 h-10 rounded-full flex items-center justify-center text-white/70 shrink-0">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </span>
    <span class="flex items-center gap-2 mr-1 shrink-0">
      <img src="@/assets/logo_colores.png" alt="" class="h-11 w-auto object-contain" />
      <span class="font-black text-lg tracking-tighter text-white uppercase">Dua<span class="text-primary-400">Lab</span></span>
    </span>
    <div class="flex-1" />
    <span class="flex h-10 items-center gap-2 rounded-full px-2.5 text-white/80 shrink-0">
      <svg class="h-5 w-5 text-amber-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"/></svg>
      <span v-if="!compacto" class="whitespace-nowrap text-[13px] font-bold">Conoce DUALAB</span>
    </span>
    <span v-if="!compacto" class="h-6 w-px shrink-0 bg-white/10" />
    <span class="flex items-center gap-2.5 rounded-full py-1.5 pl-1.5 shrink-0" :class="compacto ? 'pr-1.5' : 'pr-3'">
      <span class="relative flex h-9 w-9 items-center justify-center rounded-full bg-administraciones text-white ring-2 ring-white/20">
        <span class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full bg-emerald-400 ring-2 ring-azul-noche" />
        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
      </span>
      <template v-if="!compacto">
        <span class="flex flex-col items-start leading-tight">
          <span class="text-[13px] font-bold text-white">{{ usuario.nombre }}</span>
          <span class="text-[11px] text-white/50">{{ usuario.rol }}</span>
        </span>
        <svg class="h-4 w-4 text-white/50" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
      </template>
    </span>
  </header>
</template>

<script setup>
import { usuario } from './panelDocenteDemo'

// hamburguesa: sin SidePanel fijo, el menú se abre desde la TopBar (tablet y móvil)
defineProps({ compacto: Boolean, hamburguesa: Boolean })
</script>
