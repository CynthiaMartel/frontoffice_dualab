<template>
  <!-- Familia profesional (paleta azul de marca). Con `proximamente` la tarjeta
       no es clicable y se muestra atenuada con su etiqueta. -->
  <component
    :is="proximamente ? 'div' : RouterLink"
    v-bind="proximamente ? { 'aria-disabled': 'true' } : { to }"
    class="group relative flex flex-col items-center text-center gap-3 rounded-2xl p-6 border transition-all duration-300"
    :class="proximamente
      ? 'bg-white/60 border-dashed border-primary-200 cursor-default'
      : 'bg-white border-transparent shadow-[0_2px_12px_rgba(23,40,62,0.05)] hover:border-primary-200 hover:shadow-[0_10px_30px_rgba(23,40,62,0.08)] hover:-translate-y-0.5'"
  >
    <span v-if="proximamente" class="absolute top-3 right-3 text-[10px] font-black uppercase tracking-widest text-primary-700 bg-primary-100 border border-primary-200 px-2 py-0.5 rounded-full">
      Próximamente
    </span>
    <span
      class="w-14 h-14 rounded-2xl flex items-center justify-center transition-colors duration-300"
      :class="proximamente ? 'bg-primary-50 text-primary-300' : 'bg-primary-100 text-primary-700 group-hover:bg-primary-600 group-hover:text-white'"
    >
      <component :is="icon" class="w-7 h-7" />
    </span>
    <span class="font-heading font-bold text-sm" :class="proximamente ? 'text-gray-400' : 'text-azul-noche'">{{ nombre }}</span>
  </component>
</template>

<script setup>
import { RouterLink } from 'vue-router'

defineProps({ nombre: String, icon: Object, to: [Object, String], proximamente: Boolean })
</script>
