<template>
  <!-- Tarjeta "Alertas" de InicioDocente.vue -->
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="flex items-center gap-2 px-5 py-3.5 border-b border-gray-100">
      <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
      <span class="text-sm font-semibold text-gray-700">Alertas</span>
      <span class="inline-flex items-center justify-center w-5 h-5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700">{{ alertas.length }}</span>
    </div>
    <ul class="divide-y divide-gray-50">
      <li v-for="a in alertas" :key="a.texto" class="flex items-start gap-3 px-5 py-3">
        <div class="mt-0.5 shrink-0 w-6 h-6 rounded-full flex items-center justify-center" :class="ESTILO[a.nivel].bg">
          <svg class="w-3.5 h-3.5" :class="ESTILO[a.nivel].text" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" :d="ESTILO[a.nivel].icon"/></svg>
        </div>
        <p class="text-xs text-gray-600 leading-snug flex-1 pt-1">{{ a.texto }}</p>
        <svg class="w-3.5 h-3.5 text-gray-300 mt-1 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { alertas } from './panelDocenteDemo'

const ESTILO = {
  warning: { bg: 'bg-amber-50', text: 'text-amber-500', icon: 'M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z' },
  info:    { bg: 'bg-blue-50',  text: 'text-blue-500',  icon: 'M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z' },
  success: { bg: 'bg-green-50', text: 'text-green-500', icon: 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
}
</script>
