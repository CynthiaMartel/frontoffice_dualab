<template>
  <div class="flex gap-4 items-start p-5 rounded-2xl transition-colors" :class="cardClass">
    <div
      class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 font-black text-lg shadow-md"
      :class="badgeClass"
    >
      {{ number }}
    </div>
    <div>
      <h4 class="font-bold text-lg" :class="titleClass">{{ title }}</h4>
      <p class="text-sm leading-relaxed mt-1" :class="descClass">{{ desc }}</p>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({ number: String, icon: Object, title: String, desc: String })

const n = computed(() => Number(props.number))

// Paso 1: la Empresa propone → verde (empresas). Paso 2: la IA transforma →
// turquesa (administraciones, usado aquí como acento tecnológico neutro).
// Paso 3: el Alumnado resuelve → naranja (alumnos).
const cardClass = computed(() =>
  n.value === 2 ? 'bg-administraciones/10 border border-administraciones/20' : 'hover:bg-white'
)
const badgeClass = computed(() => {
  if (n.value === 1) return 'bg-empresas text-white'
  if (n.value === 2) return 'bg-administraciones text-white'
  return 'bg-alumnos text-white'
})
const titleClass = computed(() => {
  if (n.value === 1) return 'text-empresas'
  if (n.value === 2) return 'text-administraciones'
  return 'text-alumnos'
})
const descClass  = computed(() => 'text-gray-500')
</script>
