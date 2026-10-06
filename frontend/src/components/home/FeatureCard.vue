<template>
  <button
    type="button"
    class="group w-full h-full flex items-start gap-4 text-left bg-white rounded-2xl p-5 shadow-[0_2px_12px_rgba(23,40,62,0.05)] border border-transparent hover:border-primary-200 hover:shadow-[0_10px_30px_rgba(23,40,62,0.08)] transition-all duration-300 hover:-translate-y-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-600"
    @click="$emit('click')"
  >
    <component :is="icon" class="w-9 h-9 shrink-0" :class="iconClass" />
    <div class="flex-1 min-w-0">
      <h3 class="font-heading font-bold text-[15px] text-azul-noche leading-snug">{{ title }}</h3>
      <p class="text-sm text-gray-500 leading-snug mt-1">{{ desc }}</p>
    </div>
    <svg class="w-5 h-5 text-primary-600 shrink-0 self-end transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
    </svg>
  </button>
</template>

<script setup>
// iconClass: clase de color literal (text-centros, text-empresas…) para que Tailwind la detecte.
defineProps({ icon: Object, title: String, desc: String, iconClass: String })
defineEmits(['click'])
</script>
