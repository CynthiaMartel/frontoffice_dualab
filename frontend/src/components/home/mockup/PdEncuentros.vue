<template>
  <!-- Tarjeta "Mis encuentros" de InicioDocente.vue -->
  <section class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
    <div class="bg-[#374151] px-4 py-3 flex items-center gap-3">
      <div class="w-7 h-7 rounded-lg bg-blue-400/20 border border-blue-400/25 flex items-center justify-center shrink-0">
        <svg class="w-3.5 h-3.5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
      </div>
      <p class="text-white font-black text-sm">Mis encuentros</p>
    </div>
    <ul class="divide-y divide-gray-50">
      <li v-for="(s, i) in encuentros" :key="s.titulo" class="px-4 py-3" :class="i === 0 ? 'bg-blue-50 ring-inset ring-1 ring-blue-100' : ''">
        <div class="flex items-start gap-2">
          <div class="flex-1 min-w-0">
            <p class="text-xs font-black leading-snug truncate" :class="i === 0 ? 'text-blue-700' : 'text-[#1F2937]'">{{ s.titulo }}</p>
            <p class="text-[10px] font-bold mt-0.5" :class="i === 0 ? 'text-blue-500' : 'text-centros'">{{ s.fecha }}</p>
            <div class="flex flex-wrap gap-1 mt-1">
              <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wide bg-centros/10 text-centros">{{ s.curso }}</span>
              <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wide bg-primary-400/10 text-primary-700">Gr. {{ s.grupo }}</span>
              <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wide bg-gray-100 text-gray-500">{{ s.alumnos }} al.</span>
            </div>
          </div>
          <svg class="w-3.5 h-3.5 shrink-0 mt-0.5" :class="i === 0 ? 'text-blue-400' : 'text-gray-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </div>
      </li>
    </ul>
    <div class="px-4 py-3 border-t border-gray-50 bg-blue-50/50">
      <p class="w-full flex items-center justify-center gap-1.5 text-[10px] font-black uppercase tracking-widest text-blue-500 py-0.5">
        Ver todos los encuentros
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </p>
    </div>
  </section>
</template>

<script setup>
import { encuentros } from './panelDocenteDemo'
</script>
